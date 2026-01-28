server {
	listen      %ip%:%proxy_port%;
	server_name %domain_idn% %alias_idn%;
	error_log   /var/log/%web_system%/domains/%domain%.error.log error;

	include %home%/%user%/conf/web/%domain%/nginx.forcessl.conf*;

	location ~ /\.(?!well-known\/|file) {
		deny all;
		return 404;
	}

    location = /__auth/fpds-query {
        internal;

        proxy_ssl_server_name on;
        proxy_ssl_name $host;
        proxy_pass https://%ip%:%web_ssl_port%/__auth/fpds-query;

        proxy_set_header Host $host;
        proxy_set_header Cookie $http_cookie;
        proxy_set_header X-Original-URI $request_uri;
        proxy_set_header X-Forwarded-Proto $scheme;
        proxy_set_header X-Real-IP $remote_addr;
        proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
    }

    location @fpds_login   { return 302 /login; }
    location @fpds_paywall { return 302 /pricing; }

    location /__ch_api {
        internal;

        proxy_set_header Host $host;
        proxy_set_header X-Forwarded-Proto $scheme;
        proxy_redirect off;

        proxy_pass http://127.0.0.1:8123/;

        proxy_read_timeout 300;
        proxy_send_timeout 300;
    }

    location = /fpds/query { return 301 /fpds/query/; }

    location /fpds/query/ {
        
        proxy_set_header Host $host;
        proxy_set_header X-Forwarded-Host $host;
        proxy_set_header X-Forwarded-Proto $scheme;
        proxy_set_header X-Forwarded-Prefix /fpds/query;

        proxy_redirect off;

        proxy_pass http://127.0.0.1:8123/query/;

        proxy_read_timeout 300;
        proxy_send_timeout 300;
        
    }

	location / {
        
        # access_log /var/log/nginx/fpds_run_root.log combined;

        # ClickHouse UI
        # OPTIONS /?query=...
        # POST    /?add_http_cors_header=1&query=...
        if ($arg_query != "") { set $to_ch 1; }
        if ($arg_add_http_cors_header = "1") { set $to_ch 1; }

        if ($to_ch = 1) {
            rewrite ^ /__ch_api last;
        }

		proxy_pass http://%ip%:%web_port%;

		location ~* ^.+\.(%proxy_extensions%)$ {
			try_files  $uri @fallback;

			root       %docroot%;
			access_log /var/log/%web_system%/domains/%domain%.log combined;
			access_log /var/log/%web_system%/domains/%domain%.bytes bytes;

			expires    max;
		}
	}

	location @fallback {
		proxy_pass http://%ip%:%web_port%;
	}

	location /error/ {
		alias %home%/%user%/web/%domain%/document_errors/;
	}

	include %home%/%user%/conf/web/%domain%/nginx.conf_*;
}
