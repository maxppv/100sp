<?php

namespace App\Services;

use voku\helper\HtmlDomParser;

class HtmlParserService
{
    const PURCHASES_BLOCK_SELECTOR = '.purchases.block';
    const PURCHASES_BLOCK_TITLE_SELECTOR = 'h2 a';
    const PURCHASES_WRAPPER_BLOCK_SELECTOR = '.purchases-wrapper.purchases-items-wrapper .purchase-block';
    const PURCHASE_PROPERTIES_SELECTOR = '.properties .name a';
    const PURCHASE_PICTURE_SELECTOR = '.picture a img';

    public static function parse(string $html): array
    {
        $purchaseTypes = [];
        $html = HtmlDomParser::str_get_html($html);

        $purchasesBlocks = $html->findMulti(self::PURCHASES_BLOCK_SELECTOR);
        foreach ($purchasesBlocks as $purchasesBlock) {
            $purchaseType = new \stdClass();
            $purchaseType->alias = trim($purchasesBlock->id);
            $purchaseType->title = trim($purchasesBlock->findOne(self::PURCHASES_BLOCK_TITLE_SELECTOR)->innertext);
            // Не рассматриваем блок без всех необходимых данных
            foreach ($purchaseType as $field) {
                if (empty($field)) continue;
            }
            $purchaseType->purchases = [];

            $purchasesWrapperBlocks = $purchasesBlock->findMulti(self::PURCHASES_WRAPPER_BLOCK_SELECTOR);
            foreach ($purchasesWrapperBlocks as $purchasesWrapperBlock) {
                $purchaseProperties = $purchasesWrapperBlock->findOne(self::PURCHASE_PROPERTIES_SELECTOR);

                $purchase = new \stdClass();
                $purchase->id = trim($purchaseProperties->getAttribute('data-item-id'));;
                $purchase->name = trim($purchaseProperties->innertext);
                $purchase->url = trim($purchaseProperties->href);
                $purchase->photo = trim($purchasesWrapperBlock->findOne(self::PURCHASE_PICTURE_SELECTOR)->src);

                // Не берем покупку без всех необходимых данных
                foreach ($purchase as $field) {
                    if (empty($field)) continue;
                }

                $purchaseType->purchases[] = $purchase;
            }
            $purchaseTypes[] = $purchaseType;
        }
        return $purchaseTypes;
    }
}
