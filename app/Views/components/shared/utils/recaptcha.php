<div data-component='recaptcha' class="recaptcha fixed bottom-12 right-1 bg-white text-blue-600 w-[5vw] pl-5 hover:text-white cursor-pointer hover:bg-blue-600 h-8 pb-1 px-4 shadow-md rounded-sm">
    <div class="flex items-center">
        <div class="h-captcha" class="h-captcha" data-callback="handleRecaptcha"
            data-size="invisible" data-sitekey="2e3c109c-3934-4482-aa1a-f57c7526d492"></div>
        <i class="bi bi-shield-lock-fill header-xl"></i>
        <input type="hidden" name='res-recaptcha'>
        <div class="describe text-center ml-4 text-blue-900 line-1">
            <p>Protegido P/ Recaptcha</p>
            <a href="" class="text-xs"><u>Termos Privacidade</u></a>
        </div>
    </div>
</div>

<script src="<?= base_url("/js/libraries/Recaptcha/index.js") ?>"></script>
<script src="https://js.hcaptcha.com/1/api.js" async defer></script>