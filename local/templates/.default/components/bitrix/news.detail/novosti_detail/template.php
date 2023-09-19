<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>

<!-- Начало вывода -->
<section class="article">
  <header class="article__header">
    <!-- вывод названия -->
    <?if ($arParams["DISPLAY_NAME"] != "N" && $arResult["NAME"]): ?>
      <h1 class="article__title"><?=$arResult["NAME"]?></h1>
  	<?endif;?>
    <!-- Вывод времени -->
    <?if ($arParams["DISPLAY_DATE"] != "N" && $arResult["DISPLAY_ACTIVE_FROM"]): ?>
      <time class="article__publication-date" datetime="<?=$arResult["DISPLAY_ACTIVE_FROM"]?>"><?=$arResult["DISPLAY_ACTIVE_FROM"]?></time>
    <?endif;?>
    <a class="back-link" href="/novosti/">
      <svg class="icon" role="img">
        <use xlink:href="<?=ASSET_PATH?>icons.svg#dropdown-arrow" /></svg>
      Пресс-центр
    </a>
  </header>
  <div class="article__content-wrapper">
    <div class="article__content content-block">
      <!-- Вывод картинки -->
      <?if ($arParams["DISPLAY_PICTURE"] != "N" && is_array($arResult["DETAIL_PICTURE"])): ?>
        <img src="<?=$arResult["DETAIL_PICTURE"]["SRC"]?>" alt="<?=$arResult["DETAIL_PICTURE"]["ALT"]?>">
      <?endif?>
      <!-- Вывод основного текста -->
      <?if ($arResult["NAV_RESULT"]): ?>
            <?if ($arParams["DISPLAY_TOP_PAGER"]): ?><?=$arResult["NAV_STRING"]?><br /><?endif;?>
              <?echo $arResult["NAV_TEXT"]; ?>
            <?if ($arParams["DISPLAY_BOTTOM_PAGER"]): ?><br /><?=$arResult["NAV_STRING"]?><?endif;?>
            <?elseif (strlen($arResult["DETAIL_TEXT"]) > 0): ?>
              <p> <?echo $arResult["DETAIL_TEXT"]; ?><p>
            <?else: ?>
              <?echo $arResult["PREVIEW_TEXT"]; ?>
      <?endif?>
    </div>
  </div>
  <div class="article__content-wrapper">
    <div class="article__lead content-block">
    <!-- Вывод лида   -->
      <?if ($arParams["PROPERTY_CODE"] != "" && is_array($arResult["PROPERTIES"]) && $arResult["PROPERTIES"]["LEAD_TEXT"]["VALUE"]): ?>
        <?echo $arResult["PROPERTIES"]["LEAD_TEXT"]["VALUE"]; ?>
      <?endif?>
    </div>
  </div>
  <div class="article__content-wrapper">
    <div class="article__content content-block">
      <!-- вывод картинки с ее текстом -->

      <?if (is_array($arResult["PROPERTIES"]["MAIN_PICTURE"]) && $arResult["PROPERTIES"]["MAIN_PICTURE"]["VALUE"] != ''): ?>
        <img src="<?=CFile::GetPath($arResult["PROPERTIES"]["MAIN_PICTURE"]["VALUE"])?>" alt="<?=$arResult["PROPERTIES"]["MAIN_PICTURE"]?>">
        <?if ($arParams["PROPERTIES"]["MAIN_PICTURE_TEXT"] != "N" && is_array($arResult["PROPERTIES"]["MAIN_PICTURE_TEXT"])): ?>
          <div class="image-caption">
            <?echo $arResult["PROPERTIES"]["MAIN_PICTURE_TEXT"]["VALUE"] ?>
          </div>
      <?endif?>
      <?endif?>
      <?if ($arResult["PROPERTIES"]["QUOTE_TEXT"]["VALUE"]): ?>
        <blockquote class="blockquote" data-controller="polar-lights-masked"
          data-action="mousemove->polar-lights-masked#updateMaskPosition">
          <!-- Цитата -->
            <?echo $arResult["PROPERTIES"]["QUOTE_TEXT"]["VALUE"]; ?>
            <div class="person-info">
              <!-- Фото -->
              <?if ($arResult["PROPERTIES"]["QUOTE_AUTHOR_PHOTO"]["VALUE"]): ?>
                <img class="person-info__photo" src="<?=CFile::GetPath($arResult["PROPERTIES"]["QUOTE_AUTHOR_PHOTO"]["VALUE"])?>" alt="<?echo $arResult["PROPERTIES"]["QUOTE_AUTHOR_PHOTO"]["NAME"] ?>">
              <?endif?>
              <!--АВТОР-->
              <div class="person-info__description">
                <?if ($arResult["PROPERTIES"]["QUOTE_AUTHOR"]["VALUE"]): ?>
                  <span class="person-info__name"><?echo $arResult["PROPERTIES"]["QUOTE_AUTHOR"]["VALUE"] ?></span>
                <?endif?>
                <?if ($arResult["PROPERTIES"]["QUOTE_AUTHOR"]["DESCRIPTION"]): ?>
                <span class="person-info__position"><?echo $arResult["PROPERTIES"]["QUOTE_AUTHOR"]["DESCRIPTION"] ?></span>
                <?endif?>
              </div>
            </div>
          <div class="polar-lights polar-lights--dim">
            <div class="polar-lights__mask" data-target="polar-lights-masked.mask"></div>
          </div>

        </blockquote>
      <?endif?>
      <!-- Дополнительные фото -->
      <?if ($arResult["PROPERTIES"]["ADDITIONAL_PICTURES"]["VALUE"] != 0): ?>
        <?foreach ($arResult["PROPERTIES"]["ADDITIONAL_PICTURES"]["VALUE"] as $arAddPicID): ?>
          <img src="<?=CFile::GetPath($arAddPicID)?>" alt="<?echo $arResult["PROPERTIES"]["ADDITIONAL_PICTURES"]["NAME"] ?>">
        <?endforeach;?>
      <?endif?>
      <!-- Списки и ссылки -->
      <?if ($arResult["PROPERTIES"]["ADDITIONAL_LINKS"]["VALUE"] != 0): ?>
        <?for ($j = 0; $j < count($arResult["PROPERTIES"]["ADDITIONAL_LINKS"]["VALUE"]); $j++): ?>
        <?foreach ($arResult["PROPERTIES"]["ADDITIONAL_LINKS"]["VALUE"] as $arAddLink): ?>
          <span>
            <?echo $j + 1 ?> -
            <a href="<?echo $arResult["PROPERTIES"]["ADDITIONAL_LINKS"]["VALUE"][$j] ?>" target="_blank"
            rel="nofollow noopener"><?echo $arResult["PROPERTIES"]["ADDITIONAL_LINKS"]["VALUE"][$j] ?></a>
          </span>
        <?endforeach;?>
        <?endfor;?>
      <?endif?>
      <br>
    </div>
  </div>
</section>