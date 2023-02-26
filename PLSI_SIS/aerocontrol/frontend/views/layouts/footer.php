<?php

use yii\helpers\Html;

?>
<footer>
    <div class="[ footer-wrapper ] [ container text-align-center ]">
        <nav aria-label="Footer">
            <ul role="list" class="footer-list">
                <li class="footer-list__item"><a href="#" class="[ footer__link ] [ fs-350 letter-spacing-2 ]">Termos e Condições</a></li>
                <li class="footer-list__item"><a href="#" class="[ footer__link ] [ fs-350 letter-spacing-2 ]">Política de privacidade</a>
                </li>
                <li class="footer-list__item">
                    <?= Html::a('Contactar Suporte', ['site/contact'], ['class' => '[ footer__link ] [ fs-350 letter-spacing-2 ]']) ?>
                </li>
            </ul>
        </nav>
        <p class="fs-100 fw-light letter-spacing-2 ">@ 2022 AeroControl. Todos os direitos
            reservados.</p>
    </div>
</footer>