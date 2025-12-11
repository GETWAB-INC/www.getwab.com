<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>GETWAB</title>

    <link rel="stylesheet" href="{{ asset('css/reset.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <style>
        /* Page 1 */

/* About Section Styles START */
.about-section {
    width: 100%;
    display: flex;
    justify-content: center;
    padding: 60px 0;
}

.about-container {
    width: 100%;
    max-width: 1920px;
    padding: 60px;
    position: relative;
    display: flex;
    justify-content: center;
    align-items: center;
    margin: 0 auto;
}

.about-decoration-1 {
    position: absolute;
    top: -15px;
    left: -20px;
}

.about-decoration-2 {
    position: absolute;
    bottom: -15px;
    left: 365px;
}

.about-content {
    width: 100%;
    max-width: 1800px;
    height: 323px;
    position: relative;
    display: flex;
    justify-content: center;
    align-items: flex-start;
}

.about-text-wrapper {
    width: 100%;
    max-width: 1069px;
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    gap: 200px;
}

.about-title-wrapper {
    width: 269px;
    display: flex;
    justify-content: flex-start;
    align-items: flex-start;
}

.about-title {
    width: 270px;
    color: var(--White, white);
    font-size: 48px;
    font-family: "Overused Grotesk", sans-serif;
    font-weight: 400;
    line-height: 57.6px;
    margin: 0;
}

.about-description {
    position: relative;
    width: 100%;
    max-width: 440px;
    left: -190px;
    color: #afbcb8;
    flex: 1;
    font-size: 24px;
    font-family: "Overused Grotesk", sans-serif;
    font-weight: 400;
    line-height: 24px;
    margin: 0;
}

.about-link {
    width: 422px;
    position: absolute;
    left: 528px;
    top: 200px;
    display: flex;
    justify-content: flex-start;
    align-items: flex-start;
    gap: 16px;
    text-decoration: none;
}

.about-link-text {
    color: var(--Light-green, #b5d9a7);
    font-size: 24px;
    font-family: "Overused Grotesk", sans-serif;
    font-weight: 600;
    line-height: 24px;
    transition: all 0.3s ease;
    position: relative;
    display: inline-block;
}

.about-link-text::after {
    content: "";
    position: absolute;
    left: 0;
    bottom: -2px;
    width: 0;
    height: 2px;
    background-color: var(--Light-green, #b5d9a7);
    transition: width 0.3s ease;
}

.about-link:hover .about-link-text::after {
    width: 100%;
}

@media (max-width: 1800px) {
    .about-text-wrapper {
        gap: 200px;
    }
}

@media (max-width: 1440px) {
    .about-text-wrapper {
        gap: 150px;
    }

    .about-title {
        font-size: 42px;
        line-height: 50px;
    }

    .about-description {
        left: -70px;
        font-size: 20px;
    }

    .about-link {
        left: 420px;
    }

    .about-decoration-2 {
        left: 310px;
    }
}

@media (max-width: 1200px) {
    .about-text-wrapper {
        gap: 100px;
    }

    .about-title {
        width: 220px;
        font-size: 36px;
        line-height: 44px;
    }
}

/* About Section Styles FINISH */

/* About Section ADAPTION START */

@media (max-width: 768px) {
    .about-section {
        padding: 40px 0;
    }

    .about-container {
        padding: 20px;
    }

    .about-content {
        height: auto;
        flex-direction: column;
        align-items: flex-start;
        gap: 30px;
    }

    .about-text-wrapper {
        flex-direction: column;
        gap: 20px;
        max-width: 100%;
    }

    .about-title-wrapper {
        width: 100%;
    }

    .about-title {
        width: 180px;
        font-size: 32px;
        line-height: 38px;
    }

    .about-description {
        width: 100%;
        font-size: 18px;
        line-height: 22px;
        padding-left: 0;
        margin-top: 20px;
        left: 1px;
    }

    .about-link {
        position: static;
        width: 100%;
        margin-top: 20px;
    }

    .about-link-text {
        font-size: 18px;
    }

    .about-decoration-1 {
        left: -15px;
    }

    .about-decoration-2 {
        left: 30px;
    }

    .about-content > div:last-child {
        width: 100%;
        margin-top: 30px;
    }

    .about-content > div:last-child img {
        width: 100%;
        height: auto;
    }
}

@media (max-width: 375px) {
    .about-decoration-2 {
        left: 275px;
    }
}

@media (max-width: 320px) {
    .about-decoration-2 {
        left: 40px;
    }
}

/* About Section ADAPTION FINISH */

/* Products Section Styles START */
.products-section {
    width: 100%;
    display: flex;
    justify-content: center;
}

.products-container {
    width: 1920px;
    padding: 160px 60px;
    background: rgba(255, 255, 255, 0.14);
    border-radius: 100px;
    display: flex;
    flex-direction: column;
    gap: 85px;
}

.products-header {
    width: 269px;
    display: flex;
    flex-direction: column;
    gap: 4px;
}

.products-title {
    color: var(--White, white);
    font-size: 48px;
    font-family: "Overused Grotesk", sans-serif;
    font-weight: 400;
    line-height: 57.6px;
    margin: 0;
}

.products-content {
    display: flex;
    flex-direction: column;
    gap: 80px;
}

.product-row {
    display: flex;
    justify-content: flex-start;
    align-items: flex-start;
    gap: 140px;
    width: 1800px;
}

.product-card {
    width: 520px;
    display: flex;
    flex-direction: column;
    gap: 56px;
}

.product-info {
    display: flex;
    flex-direction: column;
    gap: 54px;
}

.product-name {
    color: var(--White, white);
    font-size: 32px;
    font-family: "Overused Grotesk", sans-serif;
    font-weight: 600;
    line-height: 32px;
    margin: 0;
}

.product-description {
    font-size: 24px;
    font-family: "Overused Grotesk", sans-serif;
    font-weight: 400;
    line-height: 24px;
    margin: 0;

    color: #afbcb8;
}

.product-button {
    width: 210px;
    padding: 20px 35px;
    background: linear-gradient(360deg, #00ad8c 0%, #00755f 51%);
    border-radius: 7px;
    display: inline-flex;
    justify-content: center;
    align-items: center;
    text-decoration: none;
    color: white;
    font-size: 24px;
    font-family: "Overused Grotesk", sans-serif;
    font-weight: 400;
    line-height: 24px;
    position: relative;
    overflow: hidden;
    z-index: 1;
    transition: color 0.3s ease;
    border: none;
    cursor: pointer;
}

.product-button::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(360deg, #00624f 0%, #005d4b 97%);
    opacity: 0;
    z-index: -1;
    transition: opacity 0.4s ease;
}

.product-button:hover::before {
    opacity: 1;
}

.product-button .button-text {
    color: inherit;
    font: inherit;
    transition: inherit;
}

.button-text {
    color: white;
    font-size: 24px;
    font-family: "Overused Grotesk", sans-serif;
    font-weight: 400;
    line-height: 24px;
}

.product-image {
    border-radius: 7px;
}

.product-row .product-image:first-child {
    width: 1140px;
    height: 707px;
}

.product-row.reverse .product-image {
    width: 1139px;
    height: 597px;
}

/* Products Section Styles FINISH */

/* Products Section ADAPTATION START */

@media (max-width: 1440px) {
    .products-container {
        width: 1440px;
        padding: 120px 40px;
        border-radius: 80px;
        gap: 60px;
    }

    .products-content {
        gap: 60px;
    }

    .product-row {
        width: 100%;
        gap: 80px;
    }

    .product-card {
        width: 440px;
        gap: 40px;
    }

    .product-info {
        gap: 40px;
    }

    .product-name {
        font-size: 28px;
        line-height: 28px;
    }

    .product-description {
        font-size: 20px;
        line-height: 20px;
    }

    .product-button {
        width: 180px;
        padding: 16px 30px;
        font-size: 20px;
        line-height: 20px;
    }

    .button-text {
        font-size: 20px;
        line-height: 20px;
    }

    .product-row img,
    .product-row.reverse img {
        width: 60%;
        height: auto;
        object-fit: contain;
    }
}

@media (max-width: 768px) {
    .products-container {
        width: 100%;
        padding: 60px 20px;
        border-radius: 10px;
        gap: 40px;
    }

    .product-row img,
    .product-row.reverse img {
        width: 100%;
    }

    .products-header {
        width: 100%;
        text-align: left;
        gap: 8px;
    }

    .products-title {
        font-size: 32px;
        line-height: 38.4px;
        text-align: left;
    }

    .products-content {
        gap: 60px;
    }

    .product-row {
        flex-direction: column;
        width: 100%;
        gap: 30px;
    }

    .product-row.reverse {
        flex-direction: column;
    }

    .product-card {
        width: 100%;
        gap: 30px;
        text-align: left;
    }

    .product-info {
        gap: 20px;
        width: 100%;
        text-align: left;
    }

    .product-name {
        font-size: 24px;
        line-height: 24px;
        text-align: left;
    }

    .product-description {
        font-size: 16px;
        line-height: 20px;
        margin-bottom: 20px;
        text-align: left;
    }

    .product-button-2 {
        display: flex;
        justify-content: center;
        align-items: center;

        margin: 0 auto;
    }

    .product-image {
        width: 100% !important;
        height: auto !important;
        order: 2;
        margin-top: 20px;
    }

    .product-row .product-card {
        order: 1;
    }

    .product-row.reverse .product-card {
        order: 1;
    }

    .product-row.reverse .product-image {
        order: 2;
    }
}

/* Products Section ADAPTATION FINISH */

/* Services Section Styles START */
.services-section {
    width: 100%;
    display: flex;
    justify-content: center;
}

.services-container {
    width: 1920px;
    height: 720px;
    position: relative;
    display: inline-flex;
    justify-content: flex-start;
    align-items: center;
    gap: 160px;
}

.services-content {
    width: 1070px;
    height: 400px;
    position: relative;
    display: flex;
    flex-direction: column;
    gap: 100px;
}

.services-header {
    display: flex;
    justify-content: space-between;
    width: 100%;
    padding-left: 60px;
}

.services-header-left {
    width: 380px;
}

.services-header-right {
    position: relative;
    width: 632px;
}

.services-title {
    color: var(--White, white);
    font-size: 48px;
    font-family: "Overused Grotesk", sans-serif;
    font-weight: 400;
    line-height: 57.6px;
    margin: 0;
}

.services-description {
    position: relative;
    color: #afbcb8;
    font-size: 24px;
    font-family: "Overused Grotesk", sans-serif;
    font-weight: 400;
    line-height: 24px;
    margin: 0 0 40px 0;
}

.services-description-quotes-1 {
    position: absolute;
    top: -10px;
    left: -15px;
}

.services-description-quotes-2 {
    position: absolute;
    bottom: -10px;
    right: 200px;
}

.services-button {
    padding: 20px 35px;
    background: linear-gradient(360deg, #00ad8c 0%, #00755f 51%);
    border-radius: 7px;
    display: inline-flex;
    justify-content: center;
    align-items: center;
    color: white;
    font-size: 24px;
    font-family: "Overused Grotesk", sans-serif;
    font-weight: 400;
    line-height: 24px;
    text-decoration: none;
    overflow: hidden;
    z-index: 1;
    position: relative;
}

.services-button-mobile {
    display: none;
}

.services-button::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(360deg, #00624f 0%, #005d4b 97%);
    opacity: 0;
    z-index: -1;
    transition: opacity 0.4s ease;
}

.services-button:hover::before {
    opacity: 1;
}

.services-scroll-container {
    width: 1920px;
    outline: 1px solid var(--Light-green, #b5d9a7);
    background: linear-gradient(
        90deg,
        rgba(198, 198, 198, 0.09) 0%,
        rgba(96, 96, 96, 0.13) 100%
    );
}

.services-scroll-track {
    display: flex;
    width: max-content;
    animation: scroll 20s linear infinite;
    will-change: transform;
}

@keyframes scroll {
    0% {
        transform: translateX(0);
    }

    100% {
        transform: translateX(-50%);
    }
}

.service-card {
    width: 517px;
    padding: 40px 80px;
    border-radius: 7px;
    display: inline-flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    gap: 10px;
    outline-offset: -1px;
    transition: all 0.3s ease;
    flex-shrink: 0;
}

.service-card-content {
    align-self: stretch;
    display: inline-flex;
    justify-content: flex-start;
    align-items: center;
    gap: 32px;
}

.service-icon-wrapper {
    position: relative;
    width: 64px;
    height: 64px;
}

.service-icon {
    width: 100%;
    height: 100%;
    object-fit: contain;
}

.service-title {
    width: 260px;
    color: var(--White, white);
    font-size: 24px;
    font-family: "Overused Grotesk", sans-serif;
    font-weight: 400;
    line-height: 24px;
    margin: 0;
}

/* Services Section Styles FINISH */

/* Services Section Styles ADAPTATION START */
@media (max-width: 768px) {
    .services-container {
        width: 100%;
        height: auto;
        flex-direction: column;
        gap: 40px;
    }

    .services-content {
        width: 100%;
        height: auto;
        gap: 30px;
    }

    .services-header {
        margin: 20px;
        flex-direction: column;
        padding-left: 0;
    }

    .services-header-left,
    .services-header-right {
        width: 100%;
    }

    .services-title {
        font-size: 32px;
        line-height: 38px;
        margin-bottom: 20px;
    }

    .services-description {
        font-size: 18px;
        line-height: 22px;
        margin-bottom: 30px;
    }

    .services-button {
        display: none;
    }

    .services-button-mobile {
        display: flex;
        width: 250px;
        padding: 15px 25px;
        font-size: 18px;
        margin-top: 30px;
        text-align: center;
        justify-content: center;
        align-items: center;
        margin: 0 auto;
        padding: 15px 25px;
        background: linear-gradient(360deg, #00ad8c 0%, #00755f 51%);
        border-radius: 7px;
        justify-content: center;
        align-items: center;
        color: white;
        font-size: 18px;
        font-family: "Overused Grotesk", sans-serif;
        font-weight: 400;
        line-height: 24px;
        text-decoration: none;
        overflow: hidden;
        z-index: 1;
        position: relative;

        text-align: center;
    }

    .services-button-mobile::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(360deg, #00624f 0%, #005d4b 97%);
        opacity: 0;
        z-index: -1;
        transition: opacity 0.4s ease;
    }

    .services-button-mobile:hover::before {
        opacity: 1;
    }

    .service-card {
        width: 280px;
        padding: 20px 30px;
    }

    .service-icon-wrapper {
        width: 40px;
        height: 40px;
    }

    .service-title {
        font-size: 16px;
        width: 180px;
    }

    .services-description-quotes-2 {
        right: 100px;
    }
}

@media (max-width: 375px) {
    .services-description-quotes-2 {
        right: 50px;
    }
}

@media (max-width: 325px) {
    .services-description {
        width: 300px;
    }

    .services-description-quotes-2 {
        right: 230px;
    }
}

/* Services Section Styles ADAPTATION FINISH */

/* Clients Section Styles START */

.clients-section {
    width: 100%;
    display: flex;
    justify-content: center;
    padding-bottom: 160px;
    padding-left: 60px;
    padding-right: 60px;
}

.clients-container {
    width: 1920px;
    display: inline-flex;
    justify-content: center;
    align-items: center;
    gap: 56px;
}

.clients-content {
    width: 1800px;
    position: relative;
    display: inline-flex;
    flex-direction: column;
    justify-content: flex-start;
    align-items: flex-start;
    gap: 64px;
}

.clients-header {
    width: 983px;
    display: inline-flex;
    justify-content: flex-start;
    align-items: center;
    gap: 340px;
}

.clients-title {
    width: 280px;
    color: var(--White, white);
    font-size: 48px;
    font-family: "Overused Grotesk", sans-serif;
    font-weight: 400;
    line-height: 57.6px;
    margin: 0;
}

.clients-description {
    width: 550px;
    color: #afbcb8;
    font-size: 24px;
    font-family: "Overused Grotesk", sans-serif;
    font-weight: 400;
    line-height: 24px;
    margin: 0;
    position: relative;
}

.clients-decoration-1 {
    position: absolute;
    left: -15px;
    top: -10px;
}

.clients-decoration-2 {
    position: absolute;
    right: -10px;
    bottom: -15px;
}

.clients-grid {
    align-self: stretch;
    display: inline-flex;
    justify-content: center;
    align-items: center;
    gap: 60px;
}

.client-card {
    position: relative;
    overflow: hidden;
    border-radius: 7px;
    width: 560px;
    height: 618px;
    background-size: cover;
    background-position: center;
}

.client-card-government {
    background-image: url("../img/main/ServiceImage.png");
}

.client-card-contractors {
    width: 564px;
    background-image: url("../img/main/ServiceImage2.png");
}

.client-card-businesses {
    background-image: url("../img/main/ServiceImage3.png");
}

.client-card-overlay {
    position: absolute;
    width: 584px;
    height: 203px;
    left: -12px;
    bottom: 0;
    background: linear-gradient(
        0deg,
        rgba(0, 0, 0, 0.84) 0%,
        rgba(51, 51, 51, 0.44) 100%
    );
    border-radius: 7px;
}

.client-card-contractors .client-card-overlay {
    left: -10px;
}

.client-card-businesses .client-card-overlay {
    top: 430px;
}

.client-card-title {
    position: absolute;
    width: 307px;
    left: 50px;
    bottom: 50px;
    color: #b5d9a7;
    font-size: 48px;
    font-family: "Overused Grotesk", sans-serif;
    font-weight: 400;
    line-height: 57.6px;
    margin: 0;
    z-index: 2;
}

/* Clients Section Styles FINISH */

/* Clients Section ADAPTATION START */
@media (max-width: 1440px) {
    .clients-section {
        padding-bottom: 120px;
        padding-left: 40px;
        padding-right: 40px;
    }

    .clients-container {
        width: 100%;
        gap: 40px;
    }

    .clients-content {
        width: 100%;
        gap: 48px;
    }

    .clients-header {
        width: 100%;
        gap: 200px;
    }

    .clients-title {
        width: 240px;
        font-size: 40px;
        line-height: 48px;
    }

    .clients-description {
        width: 480px;
        font-size: 20px;
        line-height: 20px;
    }

    .clients-decoration-1 {
        left: -12px;
        top: -8px;
        width: 20px;
    }

    .clients-decoration-2 {
        right: 125px;
        bottom: -12px;
        width: 20px;
    }

    .clients-grid {
        gap: 40px;
    }

    .client-card {
        width: 440px;
        height: 486px;
    }

    .client-card-contractors {
        width: 444px;
    }

    .client-card-overlay {
        width: 460px;
        height: 160px;
        left: -10px;
    }

    .client-card-contractors .client-card-overlay {
        left: -8px;
    }

    .client-card-businesses .client-card-overlay {
        top: 340px;
    }

    .client-card-title {
        width: 260px;
        left: 40px;
        bottom: 40px;
        font-size: 40px;
        line-height: 48px;
    }
}

@media (max-width: 768px) {
    .clients-section {
        padding: 40px 20px;
        display: flex;
        justify-content: center;
    }

    .clients-container {
        width: 100%;
        max-width: 327px;
        flex-direction: column;
        margin: 0 auto;
    }

    .clients-content {
        width: 100%;
        gap: 30px;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .clients-header {
        width: 100%;
        flex-direction: column;
        gap: 20px;
        text-align: left;
        align-items: flex-start;
    }

    .clients-title {
        width: 100%;
        font-size: 32px;
        line-height: 38px;
        text-align: left;
        margin-bottom: 15px;
    }

    .clients-description {
        width: 100%;
        font-size: 18px;
        line-height: 22px;
        text-align: left;
        padding: 0;
    }

    .clients-decoration-1,
    .clients-decoration-2 {
        display: none;
    }

    .clients-grid {
        flex-direction: column;
        gap: 20px;
        width: 100%;
        align-items: center;
    }

    .client-card {
        width: 327px;
        height: 360px;
    }

    .client-card-overlay {
        width: 327px;
        left: 0;
        height: 100px;
    }

    .client-card-title {
        font-size: 28px;
        line-height: 34px;
        width: 80%;
        left: 20px;
        bottom: 20px;
    }

    .client-card-contractors .client-card-overlay,
    .client-card-businesses .client-card-overlay {
        left: 0;
        top: auto;
        bottom: 0;
        width: 327px;
    }
}

/* Clients Section Styles ADAPTATION FINISH */

/* Choose-getwab-section Styles START */

.choose-getwab-section {
    width: 100%;
    position: relative;
    border-radius: 40px;
}

.choose-getwab-container {
    width: 100%;
    max-width: 1920px;
    height: 1000px;
    position: relative;
    overflow: hidden;
    border-radius: 40px;
    margin: 0 auto;
}

.choose-getwab-background {
    width: 100%;
    height: 100%;
    position: absolute;
    top: 0;
    left: 0;
}

.choose-getwab-background img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.choose-getwab-overlay {
    width: 100%;
    height: 100%;
    position: absolute;
    top: 0;
    left: 0;
    border-radius: 7px;
    backdrop-filter: blur(8.25px);
}

.choose-getwab-heading {
    width: 280px;
    position: absolute;
    left: 60px;
    top: 95px;
    display: flex;
    justify-content: center;
    flex-direction: column;
    color: white;
    font-size: 48px;
    font-family: "Overused Grotesk", sans-serif;
    font-weight: 400;
    line-height: 57.6px;
    margin: 0;
}

.choose-getwab-content-wrapper {
    width: 100%;
    height: 100%;
    position: absolute;
    top: 0;
    left: 0;
}

.choose-getwab-main-content {
    width: 100%;
    max-width: 1402px;
    height: 666.13px;
    position: absolute;
    left: 50%;
    top: 50%;
    transform: translate(-50%, -50%);
    display: flex;
    justify-content: center;
    align-items: center;
}

.chart-container {
    position: relative;
    width: 646.13px;
    height: 646.13px;
    filter: drop-shadow(3px 3px 5px rgba(0, 0, 0, 0.2));
}

.chart {
    width: 100%;
    height: 100%;
}

.icon-container {
    position: absolute;
    transition: all 0.8s ease;
    opacity: 0;
    transform: translateY(20px);
}

.icon-container.visible {
    opacity: 1;
    transform: translateY(0);
}

.icon {
    width: 40px;
    height: 40px;
    object-fit: contain;
    transition: all 0.5s ease;
    transform: scale(0.8);
    opacity: 0;
}

.icon.visible {
    transform: scale(1);
    opacity: 1;
}

.icon-text {
    position: absolute;
    color: rgba(181, 217, 167, 1);
    font-family: "Overused Grotesk", sans-serif;
    font-size: 16px;
    line-height: 1.3;
    text-align: center;
    width: 450px;
    transition: all 0.5s ease 0.2s;
    opacity: 0;
    transform: translateY(10px);
}

.icon-text.visible {
    opacity: 1;
    transform: translateY(0);
}

/* Choose-getwab-section Styles FINISH */

/* Choose-getwab-section ADAPTATION Styles START */

@media (max-width: 768px) {
    .choose-getwab-container {
        height: 800px;
        border-radius: 20px;
    }

    .choose-getwab-heading {
        font-size: 36px;
        left: 30px;
        top: 50px;
    }

    .chart-container {
        width: 400px;
        height: 400px;
    }

    .icon-text {
        font-size: 14px;
        width: 120px;
    }
}

/* Choose-getwab-section ADAPTATION Styles FINISH */

/* Mobile-animation Styles START */

.mobile-animation {
    display: none;
    width: 100%;
    height: 100%;
    position: absolute;
    top: 0;
    left: 0;
    justify-content: flex-end;
    align-items: center;
    padding-right: 0;
    user-select: none;
    -webkit-user-select: none;
}

.mobile-animation .wheel-container {
    position: relative;
    width: 450px;
    height: 450px;
    border-radius: 50%;
    overflow: visible;
    user-select: none;
    margin-right: -265px;
    flex-shrink: 0;
}

.mobile-animation canvas {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    max-width: 450px;
    height: auto;
    display: block;
    pointer-events: none;
    user-select: none;
    background: transparent;
}

.mobile-animation .sector-info {
    position: absolute;
    display: flex;
    align-items: center;
    pointer-events: none;
    user-select: none;
    white-space: nowrap;
    flex-direction: row-reverse;
    will-change: opacity, left, top;
    opacity: 0;
}

.mobile-animation .sector-icon {
    width: 80px;
    height: 80px;
    flex-shrink: 0;
    user-select: none;
}

.mobile-animation .sector-text {
    color: #b5d9a7;
    margin-right: 100px;
    font-size: 20px;
    max-width: 150px;
    font-weight: 400;
    text-align: right;
    user-select: none;
    font-family: "Overused Grotesk", sans-serif;
}

/* Переключаем анимации на разных устройствах */
@media (max-width: 768px) {
    .desktop-animation {
        display: none !important;
    }

    .mobile-animation {
        display: flex;
    }

    .choose-getwab-container {
        height: 800px;
    }
}

@media (min-width: 769px) {
    .mobile-animation {
        display: none !important;
    }
}

/* Mobile-animation Styles FINISH */

.wheel-container {
    position: relative;
    width: 450px;
    height: 450px;
    margin: 0 auto;
}

.sectors-info {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    opacity: 0;
    transition: opacity 0.5s ease;
}

.sectors-info.visible {
    opacity: 1;
}

.sectors-info.hidden {
    opacity: 0;
    pointer-events: none;
}

.sector-info {
    position: absolute;
    text-align: center;

    z-index: 10;
    opacity: 0;
    transition: opacity 0.5s ease, transform 0.5s ease;
    pointer-events: none;
}

.sector-info.active {
    opacity: 1;
    z-index: 20;
    pointer-events: auto;
}

.sector-info.inactive {
    opacity: 0;
    z-index: 10;
}

.sector-icon {
    width: 40px;
    height: 40px;
    margin: 0 auto 5px;
    display: block;
}

.sector-text {
    font-size: 14px;
    line-height: 1.3;
    font-weight: 500;
    color: #333;
}

@media (max-width: 425px) {
    .wheel-container {
        transform: scale(0.9);
    }

    .sector-info {
        width: 100px;
    }

    .sector-icon {
        width: 35px;
        height: 35px;
    }

    .sector-text {
        font-size: 12px;
    }

    .sector-info[data-index="0"] {
        top: 200px;
        right: 350px;
    }

    .sector-info[data-index="1"] {
        top: 200px;
        right: 350px;
    }

    .sector-info[data-index="2"] {
        top: 200px;
        right: 350px;
    }

    .sector-info[data-index="3"] {
        top: 200px;
        right: 350px;
    }

    .sector-info[data-index="4"] {
        top: 200px;
        right: 350px;
    }
}

@media (max-width: 375px) {
    .wheel-container {
        transform: scale(0.8);
    }

    .sector-info {
        width: 90px;
    }

    .sector-icon {
        width: 30px;
        height: 30px;
    }

    .sector-text {
        font-size: 11px;
    }

    /* Full control for 375px */
    .sector-info[data-index="0"] {
        top: 190px !important;
        left: 15px !important;
    }

    .sector-info[data-index="1"] {
        top: 190px !important;
        left: 15px !important;
    }

    .sector-info[data-index="2"] {
        top: 190px !important;
        left: 15px !important;
    }

    .sector-info[data-index="3"] {
        top: 190px !important;
        left: 15px !important;
    }

    .sector-info[data-index="4"] {
        top: 190px !important;
        left: 15px !important;
    }
}

@media (max-width: 325px) {
    .wheel-container {
        transform: scale(0.7);
    }

    .sector-info {
        width: 80px;
    }

    .sector-text {
        font-size: 10px;
    }

    .sector-info[data-index="0"] {
        top: 190px !important;
        right: 30px !important;
    }

    .sector-info[data-index="1"] {
        top: 190px !important;
        right: 30px !important;
    }

    .sector-info[data-index="2"] {
        top: 190px !important;
        right: 30px !important;
    }

    .sector-info[data-index="3"] {
        top: 190px !important;
        right: 30px !important;
    }

    .sector-info[data-index="4"] {
        top: 190px !important;
        right: 30px !important;
    }
}

/* Contract-data-section Styles START */

.contract-data-section {
    width: 100%;
    display: flex;
    justify-content: center;
    padding: 60px 0;
}

.contract-data-container {
    width: 100%;
    max-width: 1920px;
    padding: 60px;
    position: relative;
    display: flex;
    justify-content: center;
    align-items: center;
    margin: 0 auto;
}

.contract-data-quote-start {
    position: absolute;
    top: -15px;
    left: -20px;
}

.contract-data-quote-end {
    position: absolute;
    bottom: -15px;
    right: 60px;
}

.contract-data-content {
    width: 100%;
    max-width: 1800px;
    height: 323px;
    position: relative;
    display: flex;
    justify-content: center;
    align-items: flex-start;
}

.contract-data-text-wrapper {
    width: 100%;
    max-width: 1069px;
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    gap: 200px;
}

.contract-data-title-wrapper {
    width: 320px;
    display: flex;
    justify-content: flex-start;
    align-items: flex-start;
}

.contract-data-title {
    color: white;
    font-size: 48px;
    font-family: "Overused Grotesk", sans-serif;
    font-weight: 400;
    line-height: 57.6px;
    margin: 0;
}

.contract-data-description {
    position: relative;
    width: 100%;
    max-width: 310px;
    left: -280px;
    color: #afbcb8;
    flex: 1;
    font-size: 24px;
    font-family: "Overused Grotesk", sans-serif;
    font-weight: 400;
    line-height: 24px;
    margin: 0;
}

.contract-data-cta {
    width: 422px;
    position: absolute;
    left: 560px;
    top: 100px;
    display: flex;
    justify-content: flex-start;
    align-items: flex-start;
    gap: 16px;
    text-decoration: none;
}

.contract-button .contract-text {
    color: inherit;
    font: inherit;
    transition: inherit;
}

.contract-text {
    color: white;
    font-size: 24px;
    font-family: "Overused Grotesk", sans-serif;
    font-weight: 400;
    line-height: 24px;
}

.contract-button {
    width: 297px;
    padding: 20px 35px;
    background: linear-gradient(360deg, #00ad8c 0%, #00755f 51%);
    border-radius: 7px;
    display: inline-flex;
    justify-content: center;
    align-items: center;
    text-decoration: none;
    color: white;
    font-size: 24px;
    font-family: "Overused Grotesk", sans-serif;
    font-weight: 400;
    line-height: 24px;
    position: relative;
    overflow: hidden;
    z-index: 1;
    transition: color 0.3s ease;
    border: none;
    cursor: pointer;
}

.contract-button::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(360deg, #00624f 0%, #005d4b 97%);
    opacity: 0;
    z-index: -1;
    transition: opacity 0.4s ease;
}

.contract-button:hover::before {
    opacity: 1;
}

/* Contract-data-section Styles FINISH */

/* Contract-data-section ADAPTATION Styles START */

@media (max-width: 1800px) {
    .contract-data-text-wrapper {
        gap: 200px;
    }
}

@media (max-width: 1440px) {
    .contract-data-text-wrapper {
        gap: 150px;
    }

    .contract-data-title {
        font-size: 42px;
        line-height: 50px;
    }

    .contract-data-description {
        width: 100%;
        max-width: 300px;
        left: -170px;
        font-size: 20px;
    }

    .contract-data-cta {
        left: 450px;
    }

    .contract-data-quote-end {
        right: 130px;
    }
}

@media (max-width: 1200px) {
    .contract-data-text-wrapper {
        gap: 100px;
    }

    .contract-data-title {
        width: 220px;
        font-size: 36px;
        line-height: 44px;
    }
}

@media (max-width: 768px) {
    .contract-data-section {
        padding: 40px 0;
    }

    .contract-data-container {
        padding: 20px;
    }

    .contract-data-content {
        height: auto;
        flex-direction: column;
        align-items: flex-start;
        gap: 30px;
    }

    .contract-data-text-wrapper {
        flex-direction: column;
        gap: 30px;
        max-width: 100%;
        text-align: left;
    }

    .contract-data-title-wrapper {
        width: 100%;
        justify-content: flex-start;
    }

    .contract-data-title {
        width: 100%;
        font-size: 32px;
        line-height: 38px;
        text-align: left;
        margin-bottom: 20px;
    }

    .contract-data-description {
        width: 100%;
        font-size: 18px;
        line-height: 24px;
        padding: 0;
        position: relative;
        text-align: left;
    }

    .contract-data-quote-start {
        top: -10px;
        left: -15px;
        width: 20px;
    }

    .contract-data-quote-end {
        bottom: -10px;
        right: 5px;
        width: 20px;
    }

    .contract-data-image-mobile {
        width: 100%;
        margin: 20px 0;
        display: block;
    }

    .contract-data-image-mobile img {
        width: 100%;
        height: auto;
    }

    .contract-data-cta {
        position: static;
        width: 100%;
        justify-content: flex-start;
    }

    .contract-button {
        width: 100%;
        max-width: 280px;
        padding: 16px 25px;
        font-size: 18px;
    }
}

@media (max-width: 480px) {
    .contract-data-title {
        font-size: 28px;
        line-height: 34px;
    }

    .contract-data-description {
        left: 10px;
        font-size: 16px;
    }

    .contract-button {
        padding: 14px 20px;
        font-size: 16px;
    }

    .contract-data-quote-end {
        right: -20px;
    }
}

@media (max-width: 375px) {
    .contract-data-quote-end {
        right: -20px;
    }
}

@media (max-width: 325px) {
    .contract-data-quote-end {
        right: 200px;
    }
}

/* Contract-data-section ADAPTATION Styles FINISH */
    </style>
</head>

<body  class="is-home-page">
    @include('include.header')
    <main>
        <div class="background-video-container">
            <!-- Video Background -->
            <video autoplay muted loop playsinline class="background-video">
                <source src="{{ asset('videos/background.mp4') }}" type="video/mp4" />
            </video>

            <div class="video-overlay"></div>

            <section class="hero-section">
                <div class="hero-content">
                    <div class="hero-text-container">
                        <h1 class="hero-title">
                            Smart Data Solutions for Government and Business
                        </h1>
                        <p class="hero-subtitle">Analytics. Automation. Cybersecurity.</p>
                    </div>
                    <a href="{{ route('register') }}" class="hero-button">
                        Explore the Platform
                    </a>
                </div>
            </section>
        </div>


        <section class="about-section">
            <div class="about-container">
                <div class="about-content">
                    <div class="about-text-wrapper">
                        <div class="about-title-wrapper">
                            <h2 class="about-title">About GETWAB INC.</h2>
                        </div>
                        <p class="about-description">
                            <img class="about-decoration-1" src="{{ asset('img/ico/quotes-1.svg') }}" alt="">
                            GETWAB INC. is a U.S.-based technology company delivering
                            analytics, cybersecurity, and automation solutions. We help
                            government agencies and private businesses make smarter
                            decisions using real-time federal procurement data.
                            <img class="about-decoration-2" src="{{ asset('img/ico/quotes-2.svg') }}" alt="">
                        </p>
                    </div>

                    <div class="about-link">
                        <a href="https://www.getwab.com/capability-statement.pdf" class="about-link-text">View Capability Statement</a>
                        <img src="{{ asset('img/ico/arrow-neon.svg') }}" alt="">
                    </div>

                    <div>
                        <img src="{{ asset('img/main/SectionImage.png') }}" alt="">
                    </div>
                </div>
            </div>
        </section>

        <section class="products-section">
            <div class="products-container">
                <div class="products-header">
                    <h2 class="products-title">Our Products</h2>
                </div>

                <div class="products-content">
                    <div class="product-row">
                        <div class="product-card">
                            <div class="product-info">
                                <h3 class="product-name">FPDS Query</h3>
                                <p class="product-description">
                                    Run powerful SQL-like queries on federal procurement data
                                    with unrestricted access to all fields. Get answers fast —
                                    no API limits or delays.
                                </p>
                                <a href="{{ route('products.fpds-query') }}" class="product-button">
                                    <span class="button-text">Go to Query</span>
                                </a>
                            </div>
                        </div>
                        <img src="{{ asset('img/main/ProductImage.png') }}" alt="">
                    </div>

                    <div class="product-row reverse">
                        <img src="{{ asset('img/main/ProductImage2.png') }}" alt="">
                        <div class="product-card">
                            <div class="product-info">
                                <h3 class="product-name">FPDS Reports</h3>
                                <p class="product-description">
                                    Run powerful SQL-like queries on federal procurement data
                                    with unrestricted access to all fields. Get answers fast —
                                    no API limits or delays.
                                </p>
                                <a href="{{ route('products.fpds-reports') }}" class="product-button product-button-2">
                                    <span class="button-text">Explore</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="services-section">
            <div class="services-container">
                <div class="services-content">
                    <div class="services-header">
                        <div class="services-header-left">
                            <h2 class="services-title">Our Services</h2>
                        </div>
                        <div class="services-header-right">
                            <p class="services-description">
                                <img class="services-description-quotes-1" src="{{ asset('img/ico/quotes-1.svg') }}" alt="" />
                                Strategic consulting in analytics, <br />
                                cybersecurity, and automation. <br />
                                For both government and private clients.
                                <img class="services-description-quotes-2" src="{{ asset('img/ico/quotes-2.svg') }}" alt="" />
                            </p>
                            <a href="{{ route('contact-us') }}" class="services-button">Request Consultation</a>
                        </div>
                    </div>

                    <div class="services-scroll-container">
                        <div class="services-scroll-track">
                            <div class="service-card">
                                <div class="service-card-content">
                                    <div class="service-icon-wrapper">
                                        <img src="{{ asset('img/main/Icon-5.png') }}" alt="Data Analytics Consulting Icon" class="service-icon" />
                                    </div>
                                    <h3 class="service-title">Data Analytics Consulting</h3>
                                </div>
                            </div>
                            <div class="service-card">
                                <div class="service-card-content">
                                    <div class="service-icon-wrapper">
                                        <img src="{{ asset('img/main/Icon-1.png') }}" alt="Automation Icon" class="service-icon" />
                                    </div>
                                    <h3 class="service-title">
                                        Automation & Workflow Optimization
                                    </h3>
                                </div>
                            </div>
                            <div class="service-card">
                                <div class="service-card-content">
                                    <div class="service-icon-wrapper">
                                        <img src="{{ asset('img/main/Icon-2.png') }}" alt="Cybersecurity Icon" class="service-icon" />
                                    </div>
                                    <h3 class="service-title">Cybersecurity Advisory</h3>
                                </div>
                            </div>
                            <div class="service-card">
                                <div class="service-card-content">
                                    <div class="service-icon-wrapper">
                                        <img src="{{ asset('img/main/Icon-3.png') }}" alt="Government Icon" class="service-icon" />
                                    </div>
                                    <h3 class="service-title">
                                        Government Contracting Support
                                    </h3>
                                </div>
                            </div>
                            <div class="service-card">
                                <div class="service-card-content">
                                    <div class="service-icon-wrapper">
                                        <img src="{{ asset('img/main/Icon-4.png') }}" alt="Data Solutions Icon" class="service-icon" />
                                    </div>
                                    <h3 class="service-title">Custom Data Solutions</h3>
                                </div>
                            </div>
                            <div class="service-card">
                                <div class="service-card-content">
                                    <div class="service-icon-wrapper">
                                        <img src="{{ asset('img/main/Icon-5.png') }}" alt="Data Analytics Consulting Icon" class="service-icon" />
                                    </div>
                                    <h3 class="service-title">Data Analytics Consulting</h3>
                                </div>
                            </div>
                            <div class="service-card">
                                <div class="service-card-content">
                                    <div class="service-icon-wrapper">
                                        <img src="{{ asset('img/main/Icon-1.png') }}" alt="Automation Icon" class="service-icon" />
                                    </div>
                                    <h3 class="service-title">
                                        Automation & Workflow Optimization
                                    </h3>
                                </div>
                            </div>
                            <div class="service-card">
                                <div class="service-card-content">
                                    <div class="service-icon-wrapper">
                                        <img src="{{ asset('img/main/Icon-2.png') }}" alt="Cybersecurity Icon" class="service-icon" />
                                    </div>
                                    <h3 class="service-title">Cybersecurity Advisory</h3>
                                </div>
                            </div>
                            <div class="service-card">
                                <div class="service-card-content">
                                    <div class="service-icon-wrapper">
                                        <img src="{{ asset('img/main/Icon-3.png') }}" alt="Government Icon" class="service-icon" />
                                    </div>
                                    <h3 class="service-title">
                                        Government Contracting Support
                                    </h3>
                                </div>
                            </div>
                            <div class="service-card">
                                <div class="service-card-content">
                                    <div class="service-icon-wrapper">
                                        <img src="{{ asset('img/main/Icon-4.png') }}" alt="Data Solutions Icon" class="service-icon" />
                                    </div>
                                    <h3 class="service-title">Custom Data Solutions</h3>
                                </div>
                            </div>


                        </div>
                    </div>
                    <a href="#" class="services-button-mobile">Request Consultation</a>
                </div>
            </div>
        </section>

        <section class="clients-section">
            <div class="clients-container">
                <div class="clients-content">
                    <div class="clients-header">
                        <h2 class="clients-title">
                            Who <br />
                            We Serve
                        </h2>
                        <p class="clients-description">
                            <img src="{{ asset('img/ico/quotes-1.svg') }}" alt="" class="clients-decoration-1" />
                            Strategic consulting in analytics, <br />
                            cybersecurity, and automation. <br />
                            For both government and private clients.
                            <img src="{{ asset('img/ico/quotes-2.svg') }}" alt="" class="clients-decoration-2" />
                        </p>
                    </div>

                    <div class="clients-grid">
                        <div class="client-card client-card-government">
                            <div class="client-card-overlay"></div>
                            <h3 class="client-card-title">Government Agencies</h3>
                        </div>

                        <div class="client-card client-card-contractors">
                            <div class="client-card-overlay"></div>
                            <h3 class="client-card-title">Federal Contractors</h3>
                        </div>

                        <div class="client-card client-card-businesses">
                            <div class="client-card-overlay"></div>
                            <h3 class="client-card-title">Private Businesses</h3>
                        </div>
                    </div>
                </div>
            </div>
        </section>




  <section class="choose-getwab-section" id="why-choose-getwab">
        <div class="choose-getwab-container">
          <div class="choose-getwab-background">
            <img
              src="img/main/SectionImage2.png"
              alt="Background image"
              width="1920"
              height="1000"
            />
            <div class="choose-getwab-overlay"></div>
          </div>
          <h2 class="choose-getwab-heading">Why Choose GETWAB?</h2>
          <div class="choose-getwab-content-wrapper">
            <!-- Container for desktop animation -->
            <div class="desktop-animation">
              <div class="choose-getwab-main-content">
                <div class="chart-container">
                  <svg
                    class="chart"
                    viewBox="0 0 100 100"
                    xmlns="http://www.w3.org/2000/svg"
                  ></svg>
                </div>
              </div>
            </div>

            <!-- Container for mobile animation -->
            <div class="mobile-animation">
              <div class="wheel-container" id="wheelContainer">
                <canvas id="wheel" width="450" height="450"></canvas>

                <!-- Containers for sector information -->
                <div class="sectors-info">
                  <div class="sector-info" data-index="0">
                    <img
                      src="/img/ico/icon-2.png"
                      alt="Real-time FPDS data sync"
                      class="sector-icon"
                    />
                    <div class="sector-text">Real-time FPDS data sync</div>
                  </div>
                  <div class="sector-info" data-index="1">
                    <img
                      src="/img/ico/icon-3.png"
                      alt="Secure & scalable architecture"
                      class="sector-icon"
                    />
                    <div class="sector-text">
                      Secure & scalable architecture
                    </div>
                  </div>
                  <div class="sector-info" data-index="2">
                    <img
                      src="/img/ico/icon-4.png"
                      alt="Real-time FPDS data sync"
                      class="sector-icon"
                    />
                    <div class="sector-text">Real-time FPDS data sync</div>
                  </div>
                  <div class="sector-info" data-index="3">
                    <img
                      src="/img/ico/icon.png"
                      alt="No-code dashboards"
                      class="sector-icon"
                    />
                    <div class="sector-text">No-code dashboards</div>
                  </div>
                  <div class="sector-info" data-index="4">
                    <img
                      src="/img/ico/icon-1.png"
                      alt="High-speed backend"
                      class="sector-icon"
                    />
                    <div class="sector-text">High-speed backend</div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>


        <section class="contract-data-section">
            <div class="contract-data-container">
                <div class="contract-data-content">
                    <div class="contract-data-text-wrapper">
                        <div class="contract-data-title-wrapper">
                            <h2 class="contract-data-title">
                                Transform how you work with contract data.
                            </h2>
                        </div>
                        <p class="contract-data-description">
                            <img
                                class="contract-data-quote-start"
                                src="{{ asset('img/ico/quotes-1.svg') }}"
                                alt="" />
                            Join GETWAB and gain access to smart tools, expert insights, and
                            powerful analytics
                            <img
                                class="contract-data-quote-end"
                                src="{{ asset('img/ico/quotes-2.svg') }}"
                                alt="" />
                        </p>
                    </div>

                    <div class="contract-data-image-mobile">
                        <img src="{{ asset('img/main/SectionImage3.png') }}" alt="" />
                    </div>

                    <div class="contract-data-cta">
                        <a href="{{ route('register') }}" class="contract-button">
                            <span class="contract-text">Explore the Platform</span>
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </main>

    @include('include.footer')

    <script src="{{ asset('js/app.js') }}"></script>
</body>

</html>
