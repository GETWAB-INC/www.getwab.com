#!/bin/bash

# === ВХОДНЫЕ ДАННЫЕ (вставь сюда значения из Laravel или HTML формы) ===
SECRET_KEY='a10e614ffbc24c49a26f761f331e856d796f7a33d1814829b67a144b2b0858972882a25998ae4d5886061fa692e64dffec8d356da72f4372915322e7c9ca63cd7d0c55b8455e40c19bd345bee8d515367d0206524eae4beea274ec96ce477f373dcf82515cbf417daf8697523e593b7763e2a38c6fff4b2ba210c3412e3774d9'

DATA_TO_SIGN='access_key=abd7db4aaf5a318ebbc44297b3528a0c,profile_id=069E822B-906F-43F1-B7D1-57DE588E9AEF,transaction_uuid=bf4c27d7-17e0-4232-beaf-f5270b1389ef,signed_date_time=2025-07-30T16:20:19Z,locale=en,transaction_type=sale,reference_number=ORDER-1753892419,amount=5.00,currency=USD,payment_method=card,signed_field_names=access_key,profile_id,transaction_uuid,signed_date_time,locale,transaction_type,reference_number,amount,currency,payment_method,signed_field_names,unsigned_field_names,unsigned_field_names=card_number,card_expiry_date,card_cvn'

EXPECTED_SIGNATURE='IFwf6c82IBr+uAdoviyfvxXG3I8Xt49WvccNH8HH3Jc='

# === ПОДПИСЬ ===
ACTUAL_SIGNATURE=$(echo -n "$DATA_TO_SIGN" | openssl dgst -sha256 -hmac "$SECRET_KEY" -binary | base64)

# === СРАВНЕНИЕ ===
echo "👉 DATA TO SIGN:"
echo "$DATA_TO_SIGN"
echo
echo "✅ EXPECTED: $EXPECTED_SIGNATURE"
echo "🧮 ACTUAL  : $ACTUAL_SIGNATURE"

if [ "$ACTUAL_SIGNATURE" = "$EXPECTED_SIGNATURE" ]; then
    echo "✅ Подпись совпадает!"
else
    echo "❌ Подпись НЕ совпадает!"
fi
