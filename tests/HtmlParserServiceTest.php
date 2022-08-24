<?php

namespace App\Tests;

use App\Services\HtmlParserService;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class HtmlParserServiceTest extends KernelTestCase
{
    protected function setUp(): void
    {
        self::bootKernel();
    }

    /**
     * @throws GuzzleException
     */
    public function testHtmlParser()
    {
        $file = new \SplFileObject(dirname(__DIR__) . '/tests/100sp.html', 'r');
        $html = $file->fread($file->getSize());

        $mock = new MockHandler([new Response(200, [], $html)]);

        $handlerStack = HandlerStack::create($mock);
        $client = new Client(['handler' => $handlerStack]);
        $response = $client->request('GET', '/');

        $purchaseTypes = HtmlParserService::parse($response->getBody());

        self::assertEquals(array (
            0 =>
                (object) array(
                    'name' => 'recently',
                    'purchases' =>
                        array (
                            0 =>
                                (object) array(
                                    'id' => '907432',
                                    'name' => 'G*U*E*S*S! 30%-65% Самая Летняя Распродажа',
                                    'url' => '/purchase/907432',
                                    'photo' => 'https://cdn.100sp.ru/cache_pictures/806851140/thumb400',
                                ),
                            1 =>
                                (object) array(
                                    'id' => '961089',
                                    'name' => 'Те самые шапки с принтами и надписями',
                                    'url' => '/purchase/961089',
                                    'photo' => 'https://cdn.100sp.ru/cache_pictures/579050781/thumb400',
                                ),
                            2 =>
                                (object) array(
                                    'id' => '962377',
                                    'name' => 'Газовые печки, грили, горелки. Качество отличное',
                                    'url' => '/purchase/962377',
                                    'photo' => 'https://cdn.100sp.ru/cache_pictures/374536749/thumb400',
                                ),
                            3 =>
                                (object) array(
                                    'id' => '962154',
                                    'name' => 'ФИТОСИЛА - твоя аптека на дому. Mg и Витамин Д',
                                    'url' => '/purchase/962154',
                                    'photo' => 'https://cdn.100sp.ru/cache_pictures/861618443/thumb400',
                                ),
                            4 =>
                                (object) array(
                                    'id' => '961674',
                                    'name' => 'Шнурки которые не нужно завязывать',
                                    'url' => '/purchase/961674',
                                    'photo' => 'https://cdn.100sp.ru/cache_pictures/235480454/thumb400',
                                ),
                            5 =>
                                (object) array(
                                    'id' => '962162',
                                    'name' => 'B**G-16. New Autumn-Wunter 22/23 + Summer Sale -30%',
                                    'url' => '/purchase/962162',
                                    'photo' => 'https://cdn.100sp.ru/cache_pictures/862145261/thumb400',
                                ),
                            6 =>
                                (object) array(
                                    'id' => '962369',
                                    'name' => 'Невероятная DuSans*Новая коллекция',
                                    'url' => '/purchase/962369',
                                    'photo' => 'https://cdn.100sp.ru/cache_pictures/835228708/thumb400',
                                ),
                            7 =>
                                (object) array(
                                    'id' => '867585',
                                    'name' => 'Косметички за 150 ₽',
                                    'url' => '/purchase/867585',
                                    'photo' => 'https://cdn.100sp.ru/cache_pictures/693906461/thumb400',
                                ),
                            8 =>
                                (object) array(
                                    'id' => '900630',
                                    'name' => 'Спорт всегда в моде',
                                    'url' => '/purchase/900630',
                                    'photo' => 'https://cdn.100sp.ru/cache_pictures/164895506/thumb400',
                                ),
                            9 =>
                                (object) array(
                                    'id' => '961434',
                                    'name' => 'Огромный выбор косметики по приятным ценам',
                                    'url' => '/purchase/961434',
                                    'photo' => 'https://cdn.100sp.ru/cache_pictures/861757294/thumb400',
                                ),
                            10 =>
                                (object) array(
                                    'id' => '959949',
                                    'name' => 'MOBI-EXPRESS. Закупка мобильных аксессуаров',
                                    'url' => '/purchase/959949',
                                    'photo' => 'https://cdn.100sp.ru/cache_pictures/859880167/thumb400',
                                ),
                            11 =>
                                (object) array(
                                    'id' => '952508',
                                    'name' => 'Всё для охоты',
                                    'url' => '/purchase/952508',
                                    'photo' => 'https://cdn.100sp.ru/cache_pictures/824282810/thumb400',
                                ),
                        ),
                ),
            1 =>
                (object) array(
                    'name' => 'popular',
                    'purchases' =>
                        array (
                            0 =>
                                (object) array(
                                    'id' => '959856',
                                    'name' => 'Т-немецкое качество и комфорт. Предзаказ Весна/Лето 2023',
                                    'url' => '/purchase/959856',
                                    'photo' => 'https://cdn.100sp.ru/cache_pictures/859678050/thumb400',
                                ),
                            1 =>
                                (object) array(
                                    'id' => '961427',
                                    'name' => 'Рисовая бумага, лапша фо, специи, соусы и много другого',
                                    'url' => '/purchase/961427',
                                    'photo' => 'https://cdn.100sp.ru/cache_pictures/859720080/thumb400',
                                ),
                            2 =>
                                (object) array(
                                    'id' => '962285',
                                    'name' => 'EMKA — Распродажа+спецпредложение! Очень много верхней одежды',
                                    'url' => '/purchase/962285',
                                    'photo' => 'https://cdn.100sp.ru/cache_pictures/861950740/thumb400',
                                ),
                            3 =>
                                (object) array(
                                    'id' => '961902',
                                    'name' => 'Barbara Geratti-15. Предзаказ Party 22/23. Оплата 30%',
                                    'url' => '/purchase/961902',
                                    'photo' => 'https://cdn.100sp.ru/cache_pictures/860751039/thumb400',
                                ),
                            4 =>
                                (object) array(
                                    'id' => '961226',
                                    'name' => 'Всё от А(утлета) до Я(понии)Чистота и уют вашего дома',
                                    'url' => '/purchase/961226',
                                    'photo' => 'https://cdn.100sp.ru/cache_pictures/419561413/thumb400',
                                ),
                            5 =>
                                (object) array(
                                    'id' => '819006',
                                    'name' => 'Новинка! Корейские паровые маски для глаз',
                                    'url' => '/purchase/819006',
                                    'photo' => 'https://cdn.100sp.ru/cache_pictures/667752389/thumb400',
                                ),
                            6 =>
                                (object) array(
                                    'id' => '933993',
                                    'name' => '«Рич Кофе» Кофе зерно/молотый/Без кофеина/2в1',
                                    'url' => '/purchase/933993',
                                    'photo' => 'https://cdn.100sp.ru/cache_pictures/815715198/thumb400',
                                ),
                            7 =>
                                (object) array(
                                    'id' => '704012',
                                    'name' => 'Красота для Вашего дома: дождь не повод сидеть дома',
                                    'url' => '/purchase/704012',
                                    'photo' => 'https://cdn.100sp.ru/cache_pictures/856374893/thumb400',
                                ),
                        ),
                ),
            2 =>
                (object) array(
                    'name' => 'express',
                    'purchases' =>
                        array (
                            0 =>
                                (object) array(
                                    'id' => '770976',
                                    'name' => 'Japan: Korea Бытовая химия и косметика',
                                    'url' => '/purchase/770976',
                                    'photo' => '/static/img/lazy-stub.png',
                                ),
                            1 =>
                                (object) array(
                                    'id' => '686702',
                                    'name' => 'Вся бытовая химия в одной закупке',
                                    'url' => '/purchase/686702',
                                    'photo' => '/static/img/lazy-stub.png',
                                ),
                            2 =>
                                (object) array(
                                    'id' => '895608',
                                    'name' => 'Обвал Цен на Корейскую косметику',
                                    'url' => '/purchase/895608',
                                    'photo' => '/static/img/lazy-stub.png',
                                ),
                            3 =>
                                (object) array(
                                    'id' => '704894',
                                    'name' => 'Постельное белье. Шторы и тюль. Подушки и одеяла. Лучшие цены',
                                    'url' => '/purchase/704894',
                                    'photo' => '/static/img/lazy-stub.png',
                                ),
                            4 =>
                                (object) array(
                                    'id' => '896726',
                                    'name' => 'Дарья + Натали. Одежда в наличии. Новое поступление',
                                    'url' => '/purchase/896726',
                                    'photo' => '/static/img/lazy-stub.png',
                                ),
                            5 =>
                                (object) array(
                                    'id' => '731521',
                                    'name' => 'Витамины, капли и др. Все в наличии! Свежий приход, скидки',
                                    'url' => '/purchase/731521',
                                    'photo' => '/static/img/lazy-stub.png',
                                ),
                            6 =>
                                (object) array(
                                    'id' => '693329',
                                    'name' => 'Манго 500 гр - 250 руб, лапша и кофе из Вьетнама',
                                    'url' => '/purchase/693329',
                                    'photo' => '/static/img/lazy-stub.png',
                                ),
                            7 =>
                                (object) array(
                                    'id' => '716382',
                                    'name' => 'Японские Бады для красоты и иммунитета',
                                    'url' => '/purchase/716382',
                                    'photo' => '/static/img/lazy-stub.png',
                                ),
                        ),
                ),
            3 =>
                (object) array(
                    'name' => 'food',
                    'purchases' =>
                        array (
                            0 =>
                                (object) array(
                                    'id' => '856194',
                                    'name' => 'ФитПарад. Шоколадная паста, сгущенка, джем на стевии',
                                    'url' => '/purchase/856194',
                                    'photo' => '/static/img/lazy-stub.png',
                                ),
                            1 =>
                                (object) array(
                                    'id' => '781440',
                                    'name' => 'Приморский кондитер. Конфеты, зефир, шоколад',
                                    'url' => '/purchase/781440',
                                    'photo' => '/static/img/lazy-stub.png',
                                ),
                            2 =>
                                (object) array(
                                    'id' => '833372',
                                    'name' => 'Копченые специи — секрет хозяйки. Приправы, специи',
                                    'url' => '/purchase/833372',
                                    'photo' => '/static/img/lazy-stub.png',
                                ),
                            3 =>
                                (object) array(
                                    'id' => '756213',
                                    'name' => 'Бакалейный супермаркет Для заботливой хозяйки',
                                    'url' => '/purchase/756213',
                                    'photo' => '/static/img/lazy-stub.png',
                                ),
                        ),
                ),
            4 =>
                (object) array(
                    'name' => 'sp',
                    'purchases' =>
                        array (
                            0 =>
                                (object) array(
                                    'id' => '829714',
                                    'name' => 'Платья для принцесс! Новинки осень 2022! Трикотаж от 119р',
                                    'url' => '/purchase/829714',
                                    'photo' => '/static/img/lazy-stub.png',
                                ),
                            1 =>
                                (object) array(
                                    'id' => '780881',
                                    'name' => 'Ваши красивые волосы (Корея) Korea Beauty Lab',
                                    'url' => '/purchase/780881',
                                    'photo' => '/static/img/lazy-stub.png',
                                ),
                            2 =>
                                (object) array(
                                    'id' => '960985',
                                    'name' => 'KRISTALLER — территория Профессионалов Парикмахерский рай',
                                    'url' => '/purchase/960985',
                                    'photo' => '/static/img/lazy-stub.png',
                                ),
                            3 =>
                                (object) array(
                                    'id' => '800721',
                                    'name' => 'Украшения для Вас',
                                    'url' => '/purchase/800721',
                                    'photo' => '/static/img/lazy-stub.png',
                                ),
                            4 =>
                                (object) array(
                                    'id' => '958690',
                                    'name' => 'Детская ортопедическая обувь TWIKI',
                                    'url' => '/purchase/958690',
                                    'photo' => '/static/img/lazy-stub.png',
                                ),
                            5 =>
                                (object) array(
                                    'id' => '725059',
                                    'name' => 'Полезности для телефонов и компьютеров',
                                    'url' => '/purchase/725059',
                                    'photo' => '/static/img/lazy-stub.png',
                                ),
                            6 =>
                                (object) array(
                                    'id' => '961101',
                                    'name' => 'Женская одежда из Белоруссии',
                                    'url' => '/purchase/961101',
                                    'photo' => '/static/img/lazy-stub.png',
                                ),
                            7 =>
                                (object) array(
                                    'id' => '961661',
                                    'name' => 'Женские блузки, брюки, юбки, жакеты',
                                    'url' => '/purchase/961661',
                                    'photo' => '/static/img/lazy-stub.png',
                                ),
                            8 =>
                                (object) array(
                                    'id' => '961380',
                                    'name' => 'KOREA BEAUTY Обвал цен! -60% на хиты корейской косметики',
                                    'url' => '/purchase/961380',
                                    'photo' => '/static/img/lazy-stub.png',
                                ),
                            9 =>
                                (object) array(
                                    'id' => '962015',
                                    'name' => 'S Лето продолжается! Белые банты, заколки, бижутерия, очки',
                                    'url' => '/purchase/962015',
                                    'photo' => '/static/img/lazy-stub.png',
                                ),
                            10 =>
                                (object) array(
                                    'id' => '872036',
                                    'name' => 'КАЗАХСТАН. Сгущенка и мармелад Казахстан',
                                    'url' => '/purchase/872036',
                                    'photo' => '/static/img/lazy-stub.png',
                                ),
                            11 =>
                                (object) array(
                                    'id' => '938941',
                                    'name' => 'Wonder Lab Экопена 3 в 1 для мытья рук, фруктов, овощей',
                                    'url' => '/purchase/938941',
                                    'photo' => '/static/img/lazy-stub.png',
                                ),
                            12 =>
                                (object) array(
                                    'id' => '777661',
                                    'name' => 'Кигуруми',
                                    'url' => '/purchase/777661',
                                    'photo' => '/static/img/lazy-stub.png',
                                ),
                            13 =>
                                (object) array(
                                    'id' => '757709',
                                    'name' => 'Ликвидация Склада! **Одежда и товары для здоровья! Скидки',
                                    'url' => '/purchase/757709',
                                    'photo' => '/static/img/lazy-stub.png',
                                ),
                            14 =>
                                (object) array(
                                    'id' => '958039',
                                    'name' => 'Больше никакой влажности в доме! Осушитель воздуха',
                                    'url' => '/purchase/958039',
                                    'photo' => '/static/img/lazy-stub.png',
                                ),
                            15 =>
                                (object) array(
                                    'id' => '960778',
                                    'name' => 'S Мир посуды для любого случая. Тандыры, Казаны',
                                    'url' => '/purchase/960778',
                                    'photo' => '/static/img/lazy-stub.png',
                                ),
                            16 =>
                                (object) array(
                                    'id' => '947543',
                                    'name' => 'Чугунные казаны с быстрой доставкой! Пора на природу',
                                    'url' => '/purchase/947543',
                                    'photo' => '/static/img/lazy-stub.png',
                                ),
                            17 =>
                                (object) array(
                                    'id' => '960893',
                                    'name' => 'SVYATNYH! Джинсы и джоггеры! Большой выбор мужской одежды',
                                    'url' => '/purchase/960893',
                                    'photo' => '/static/img/lazy-stub.png',
                                ),
                            18 =>
                                (object) array(
                                    'id' => '961037',
                                    'name' => 'Мир ароматов! Летнее арома настроение! Много в наличии',
                                    'url' => '/purchase/961037',
                                    'photo' => '/static/img/lazy-stub.png',
                                ),
                            19 =>
                                (object) array(
                                    'id' => '962003',
                                    'name' => 'S Большая интерьерная! Сувениры и декор',
                                    'url' => '/purchase/962003',
                                    'photo' => '/static/img/lazy-stub.png',
                                ),
                            20 =>
                                (object) array(
                                    'id' => '756091',
                                    'name' => 'Туалетная бумага, салфетки и подгузники-трусики Komorebi',
                                    'url' => '/purchase/756091',
                                    'photo' => '/static/img/lazy-stub.png',
                                ),
                            21 =>
                                (object) array(
                                    'id' => '958192',
                                    'name' => 'НИВЕЯ - уход для лица и тела. Лучшая цена! Новинки, быстрая',
                                    'url' => '/purchase/958192',
                                    'photo' => '/static/img/lazy-stub.png',
                                ),
                            22 =>
                                (object) array(
                                    'id' => '961958',
                                    'name' => 'Обвал цен на таблетки для ПММ SOMAT',
                                    'url' => '/purchase/961958',
                                    'photo' => '/static/img/lazy-stub.png',
                                ),
                            23 =>
                                (object) array(
                                    'id' => '952199',
                                    'name' => 'TIGI МЕГА объем волос BIGGER THE BETTER. Новинки',
                                    'url' => '/purchase/952199',
                                    'photo' => '/static/img/lazy-stub.png',
                                ),
                            24 =>
                                (object) array(
                                    'id' => '925525',
                                    'name' => 'Beauty Club — Косметика с мужским характером',
                                    'url' => '/purchase/925525',
                                    'photo' => '/static/img/lazy-stub.png',
                                ),
                            25 =>
                                (object) array(
                                    'id' => '962010',
                                    'name' => 'S Канцелярский супермаркет! Школа и творчество',
                                    'url' => '/purchase/962010',
                                    'photo' => '/static/img/lazy-stub.png',
                                ),
                            26 =>
                                (object) array(
                                    'id' => '899900',
                                    'name' => 'Рагу, уха, печень минтая Камчатка! Рагу, горбуша, сайра',
                                    'url' => '/purchase/899900',
                                    'photo' => '/static/img/lazy-stub.png',
                                ),
                            27 =>
                                (object) array(
                                    'id' => '927335',
                                    'name' => 'АКЦИЯ / Декоративная и уходовая косметика из Азии НОВИНКИ',
                                    'url' => '/purchase/927335',
                                    'photo' => '/static/img/lazy-stub.png',
                                ),
                            28 =>
                                (object) array(
                                    'id' => '712659',
                                    'name' => 'Крошка Подгузники из Японии, Кореи и Китая',
                                    'url' => '/purchase/712659',
                                    'photo' => '/static/img/lazy-stub.png',
                                ),
                            29 =>
                                (object) array(
                                    'id' => '961276',
                                    'name' => 'Мебель из Карельской Сосны',
                                    'url' => '/purchase/961276',
                                    'photo' => '/static/img/lazy-stub.png',
                                ),
                            30 =>
                                (object) array(
                                    'id' => '958616',
                                    'name' => 'Аzzаrti — лучшая школьная форма для детей',
                                    'url' => '/purchase/958616',
                                    'photo' => '/static/img/lazy-stub.png',
                                ),
                            31 =>
                                (object) array(
                                    'id' => '938426',
                                    'name' => 'Лето ближе, чем кажется. Наличие. Деткам от 4-х до 16- ти',
                                    'url' => '/purchase/938426',
                                    'photo' => '/static/img/lazy-stub.png',
                                ),
                            32 =>
                                (object) array(
                                    'id' => '883220',
                                    'name' => 'Термобелье T-SOD и Домашняя одежда из Иваново',
                                    'url' => '/purchase/883220',
                                    'photo' => '/static/img/lazy-stub.png',
                                ),
                            33 =>
                                (object) array(
                                    'id' => '945673',
                                    'name' => 'Одежда для охоты, рыбалки, туризма и активного отдыха',
                                    'url' => '/purchase/945673',
                                    'photo' => '/static/img/lazy-stub.png',
                                ),
                            34 =>
                                (object) array(
                                    'id' => '922418',
                                    'name' => 'Aroma Jazz. Натуральные масла для лица и тела',
                                    'url' => '/purchase/922418',
                                    'photo' => '/static/img/lazy-stub.png',
                                ),
                            35 =>
                                (object) array(
                                    'id' => '872376',
                                    'name' => 'Итальянские обои, качество проверенное временем',
                                    'url' => '/purchase/872376',
                                    'photo' => '/static/img/lazy-stub.png',
                                ),
                            36 =>
                                (object) array(
                                    'id' => '960013',
                                    'name' => '*Большая распродажа любимой посуды',
                                    'url' => '/purchase/960013',
                                    'photo' => '/static/img/lazy-stub.png',
                                ),
                            37 =>
                                (object) array(
                                    'id' => '935387',
                                    'name' => 'Новинка! Пряжа на любой вкус и цвет! Быстрая раздача',
                                    'url' => '/purchase/935387',
                                    'photo' => '/static/img/lazy-stub.png',
                                ),
                            38 =>
                                (object) array(
                                    'id' => '701215',
                                    'name' => 'МАЛАВИТ - натуральная косметика из Алтая',
                                    'url' => '/purchase/701215',
                                    'photo' => '/static/img/lazy-stub.png',
                                ),
                            39 =>
                                (object) array(
                                    'id' => '792156',
                                    'name' => 'Накидки из алькантары AKUMA! Нежный и приятный аксессуар',
                                    'url' => '/purchase/792156',
                                    'photo' => '/static/img/lazy-stub.png',
                                ),
                            40 =>
                                (object) array(
                                    'id' => '883965',
                                    'name' => 'На море, на пляж… шикарные полотенца',
                                    'url' => '/purchase/883965',
                                    'photo' => '/static/img/lazy-stub.png',
                                ),
                            41 =>
                                (object) array(
                                    'id' => '960621',
                                    'name' => 'Декоративные свечи, создаем тепло и уют',
                                    'url' => '/purchase/960621',
                                    'photo' => '/static/img/lazy-stub.png',
                                ),
                            42 =>
                                (object) array(
                                    'id' => '960634',
                                    'name' => 'Комбинезоны, куртки и ветровки для детей Softshell',
                                    'url' => '/purchase/960634',
                                    'photo' => '/static/img/lazy-stub.png',
                                ),
                            43 =>
                                (object) array(
                                    'id' => '746105',
                                    'name' => 'Гелевая маска, снимающая отечность и темные круги под глазам',
                                    'url' => '/purchase/746105',
                                    'photo' => '/static/img/lazy-stub.png',
                                ),
                            44 =>
                                (object) array(
                                    'id' => '762004',
                                    'name' => 'Японские колготки GUNZE',
                                    'url' => '/purchase/762004',
                                    'photo' => '/static/img/lazy-stub.png',
                                ),
                            45 =>
                                (object) array(
                                    'id' => '957514',
                                    'name' => 'Оптима — Термобелье и домашняя одежда для всей семьи. Новинки',
                                    'url' => '/purchase/957514',
                                    'photo' => '/static/img/lazy-stub.png',
                                ),
                            46 =>
                                (object) array(
                                    'id' => '937908',
                                    'name' => 'Детская одежда по низким ценам в наличии',
                                    'url' => '/purchase/937908',
                                    'photo' => '/static/img/lazy-stub.png',
                                ),
                            47 =>
                                (object) array(
                                    'id' => '804385',
                                    'name' => 'Perfecta. Остатки по старым ценам',
                                    'url' => '/purchase/804385',
                                    'photo' => '/static/img/lazy-stub.png',
                                ),
                            48 =>
                                (object) array(
                                    'id' => '865252',
                                    'name' => 'Модные чалмы от Русбубона',
                                    'url' => '/purchase/865252',
                                    'photo' => '/static/img/lazy-stub.png',
                                ),
                            49 =>
                                (object) array(
                                    'id' => '935965',
                                    'name' => 'Всё самое нужное для дома. Цены вас приятно удивят',
                                    'url' => '/purchase/935965',
                                    'photo' => '/static/img/lazy-stub.png',
                                ),
                            50 =>
                                (object) array(
                                    'id' => '897043',
                                    'name' => 'Консервируй с Любимым Dr. Oetker',
                                    'url' => '/purchase/897043',
                                    'photo' => '/static/img/lazy-stub.png',
                                ),
                            51 =>
                                (object) array(
                                    'id' => '779411',
                                    'name' => '• PAMPERS • Выгодные цены. Подарки за покупку',
                                    'url' => '/purchase/779411',
                                    'photo' => '/static/img/lazy-stub.png',
                                ),
                            52 =>
                                (object) array(
                                    'id' => '944429',
                                    'name' => 'Клеoна -мир растительной космоцевтики. Поступление товара',
                                    'url' => '/purchase/944429',
                                    'photo' => '/static/img/lazy-stub.png',
                                ),
                            53 =>
                                (object) array(
                                    'id' => '961244',
                                    'name' => 'Продукты на основе черного тмина',
                                    'url' => '/purchase/961244',
                                    'photo' => '/static/img/lazy-stub.png',
                                ),
                            54 =>
                                (object) array(
                                    'id' => '864691',
                                    'name' => 'Органик косметика — все лучшее для тебя',
                                    'url' => '/purchase/864691',
                                    'photo' => '/static/img/lazy-stub.png',
                                ),
                            55 =>
                                (object) array(
                                    'id' => '898162',
                                    'name' => 'Удобная одежда до 72 размера',
                                    'url' => '/purchase/898162',
                                    'photo' => '/static/img/lazy-stub.png',
                                ),
                        ),
                ),
        )
        , $purchaseTypes);
    }
}
