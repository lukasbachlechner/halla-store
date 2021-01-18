<?php

namespace Core\Helpers;

/**
 * Class StaticData
 *
 * Diese Klasse bietet die Möglichkeit statische Daten einfach abzurufen. Aktuell verwenden wir sie nur für eine Liste
 * aller Länder der Welt, damit wir das Country-Dropdown im Adress-Formular befüllen können.
 *
 * @package Core\Helpers
 */
class StaticData
{

    const COUNTRIES = [
        [
            'id' => 4,
            'name' => 'Afghanistan',
            'alpha2' => 'af',
            'alpha3' => 'afg'
        ],
        [
            'id' => 818,
            'name' => 'Ägypten',
            'alpha2' => 'eg',
            'alpha3' => 'egy'
        ],
        [
            'id' => 8,
            'name' => 'Albanien',
            'alpha2' => 'al',
            'alpha3' => 'alb'
        ],
        [
            'id' => 12,
            'name' => 'Algerien',
            'alpha2' => 'dz',
            'alpha3' => 'dza'
        ],
        [
            'id' => 20,
            'name' => 'Andorra',
            'alpha2' => 'ad',
            'alpha3' => 'and'
        ],
        [
            'id' => 24,
            'name' => 'Angola',
            'alpha2' => 'ao',
            'alpha3' => 'ago'
        ],
        [
            'id' => 28,
            'name' => 'Antigua und Barbuda',
            'alpha2' => 'ag',
            'alpha3' => 'atg'
        ],
        [
            'id' => 226,
            'name' => 'Äquatorialguinea',
            'alpha2' => 'gq',
            'alpha3' => 'gnq'
        ],
        [
            'id' => 32,
            'name' => 'Argentinien',
            'alpha2' => 'ar',
            'alpha3' => 'arg'
        ],
        [
            'id' => 51,
            'name' => 'Armenien',
            'alpha2' => 'am',
            'alpha3' => 'arm'
        ],
        [
            'id' => 31,
            'name' => 'Aserbaidschan',
            'alpha2' => 'az',
            'alpha3' => 'aze'
        ],
        [
            'id' => 231,
            'name' => 'Äthiopien',
            'alpha2' => 'et',
            'alpha3' => 'eth'
        ],
        [
            'id' => 36,
            'name' => 'Australien',
            'alpha2' => 'au',
            'alpha3' => 'aus'
        ],
        [
            'id' => 44,
            'name' => 'Bahamas',
            'alpha2' => 'bs',
            'alpha3' => 'bhs'
        ],
        [
            'id' => 48,
            'name' => 'Bahrain',
            'alpha2' => 'bh',
            'alpha3' => 'bhr'
        ],
        [
            'id' => 50,
            'name' => 'Bangladesch',
            'alpha2' => 'bd',
            'alpha3' => 'bgd'
        ],
        [
            'id' => 52,
            'name' => 'Barbados',
            'alpha2' => 'bb',
            'alpha3' => 'brb'
        ],
        [
            'id' => 112,
            'name' => 'Belarus',
            'alpha2' => 'by',
            'alpha3' => 'blr'
        ],
        [
            'id' => 56,
            'name' => 'Belgien',
            'alpha2' => 'be',
            'alpha3' => 'bel'
        ],
        [
            'id' => 84,
            'name' => 'Belize',
            'alpha2' => 'bz',
            'alpha3' => 'blz'
        ],
        [
            'id' => 204,
            'name' => 'Benin',
            'alpha2' => 'bj',
            'alpha3' => 'ben'
        ],
        [
            'id' => 64,
            'name' => 'Bhutan',
            'alpha2' => 'bt',
            'alpha3' => 'btn'
        ],
        [
            'id' => 68,
            'name' => 'Bolivien',
            'alpha2' => 'bo',
            'alpha3' => 'bol'
        ],
        [
            'id' => 70,
            'name' => 'Bosnien und Herzegowina',
            'alpha2' => 'ba',
            'alpha3' => 'bih'
        ],
        [
            'id' => 72,
            'name' => 'Botswana',
            'alpha2' => 'bw',
            'alpha3' => 'bwa'
        ],
        [
            'id' => 76,
            'name' => 'Brasilien',
            'alpha2' => 'br',
            'alpha3' => 'bra'
        ],
        [
            'id' => 96,
            'name' => 'Brunei',
            'alpha2' => 'bn',
            'alpha3' => 'brn'
        ],
        [
            'id' => 100,
            'name' => 'Bulgarien',
            'alpha2' => 'bg',
            'alpha3' => 'bgr'
        ],
        [
            'id' => 854,
            'name' => 'Burkina Faso',
            'alpha2' => 'bf',
            'alpha3' => 'bfa'
        ],
        [
            'id' => 108,
            'name' => 'Burundi',
            'alpha2' => 'bi',
            'alpha3' => 'bdi'
        ],
        [
            'id' => 152,
            'name' => 'Chile',
            'alpha2' => 'cl',
            'alpha3' => 'chl'
        ],
        [
            'id' => 156,
            'name' => 'Volksrepublik China',
            'alpha2' => 'cn',
            'alpha3' => 'chn'
        ],
        [
            'id' => 188,
            'name' => 'Costa Rica',
            'alpha2' => 'cr',
            'alpha3' => 'cri'
        ],
        [
            'id' => 208,
            'name' => 'Dänemark',
            'alpha2' => 'dk',
            'alpha3' => 'dnk'
        ],
        [
            'id' => 276,
            'name' => 'Deutschland',
            'alpha2' => 'de',
            'alpha3' => 'deu'
        ],
        [
            'id' => 212,
            'name' => 'Dominica',
            'alpha2' => 'dm',
            'alpha3' => 'dma'
        ],
        [
            'id' => 214,
            'name' => 'Dominikanische Republik',
            'alpha2' => 'do',
            'alpha3' => 'dom'
        ],
        [
            'id' => 262,
            'name' => 'Dschibuti',
            'alpha2' => 'dj',
            'alpha3' => 'dji'
        ],
        [
            'id' => 218,
            'name' => 'Ecuador',
            'alpha2' => 'ec',
            'alpha3' => 'ecu'
        ],
        [
            'id' => 384,
            'name' => 'Elfenbeinküste',
            'alpha2' => 'ci',
            'alpha3' => 'civ'
        ],
        [
            'id' => 222,
            'name' => 'El Salvador',
            'alpha2' => 'sv',
            'alpha3' => 'slv'
        ],
        [
            'id' => 232,
            'name' => 'Eritrea',
            'alpha2' => 'er',
            'alpha3' => 'eri'
        ],
        [
            'id' => 233,
            'name' => 'Estland',
            'alpha2' => 'ee',
            'alpha3' => 'est'
        ],
        [
            'id' => 748,
            'name' => 'Eswatini',
            'alpha2' => 'sz',
            'alpha3' => 'swz'
        ],
        [
            'id' => 242,
            'name' => 'Fidschi',
            'alpha2' => 'fj',
            'alpha3' => 'fji'
        ],
        [
            'id' => 246,
            'name' => 'Finnland',
            'alpha2' => 'fi',
            'alpha3' => 'fin'
        ],
        [
            'id' => 250,
            'name' => 'Frankreich',
            'alpha2' => 'fr',
            'alpha3' => 'fra'
        ],
        [
            'id' => 266,
            'name' => 'Gabun',
            'alpha2' => 'ga',
            'alpha3' => 'gab'
        ],
        [
            'id' => 270,
            'name' => 'Gambia',
            'alpha2' => 'gm',
            'alpha3' => 'gmb'
        ],
        [
            'id' => 268,
            'name' => 'Georgien',
            'alpha2' => 'ge',
            'alpha3' => 'geo'
        ],
        [
            'id' => 288,
            'name' => 'Ghana',
            'alpha2' => 'gh',
            'alpha3' => 'gha'
        ],
        [
            'id' => 308,
            'name' => 'Grenada',
            'alpha2' => 'gd',
            'alpha3' => 'grd'
        ],
        [
            'id' => 300,
            'name' => 'Griechenland',
            'alpha2' => 'gr',
            'alpha3' => 'grc'
        ],
        [
            'id' => 320,
            'name' => 'Guatemala',
            'alpha2' => 'gt',
            'alpha3' => 'gtm'
        ],
        [
            'id' => 324,
            'name' => 'Guinea',
            'alpha2' => 'gn',
            'alpha3' => 'gin'
        ],
        [
            'id' => 624,
            'name' => 'Guinea-Bissau',
            'alpha2' => 'gw',
            'alpha3' => 'gnb'
        ],
        [
            'id' => 328,
            'name' => 'Guyana',
            'alpha2' => 'gy',
            'alpha3' => 'guy'
        ],
        [
            'id' => 332,
            'name' => 'Haiti',
            'alpha2' => 'ht',
            'alpha3' => 'hti'
        ],
        [
            'id' => 340,
            'name' => 'Honduras',
            'alpha2' => 'hn',
            'alpha3' => 'hnd'
        ],
        [
            'id' => 356,
            'name' => 'Indien',
            'alpha2' => 'in',
            'alpha3' => 'ind'
        ],
        [
            'id' => 360,
            'name' => 'Indonesien',
            'alpha2' => 'id',
            'alpha3' => 'idn'
        ],
        [
            'id' => 368,
            'name' => 'Irak',
            'alpha2' => 'iq',
            'alpha3' => 'irq'
        ],
        [
            'id' => 364,
            'name' => 'Iran',
            'alpha2' => 'ir',
            'alpha3' => 'irn'
        ],
        [
            'id' => 372,
            'name' => 'Irland',
            'alpha2' => 'ie',
            'alpha3' => 'irl'
        ],
        [
            'id' => 352,
            'name' => 'Island',
            'alpha2' => 'is',
            'alpha3' => 'isl'
        ],
        [
            'id' => 376,
            'name' => 'Israel',
            'alpha2' => 'il',
            'alpha3' => 'isr'
        ],
        [
            'id' => 380,
            'name' => 'Italien',
            'alpha2' => 'it',
            'alpha3' => 'ita'
        ],
        [
            'id' => 388,
            'name' => 'Jamaika',
            'alpha2' => 'jm',
            'alpha3' => 'jam'
        ],
        [
            'id' => 392,
            'name' => 'Japan',
            'alpha2' => 'jp',
            'alpha3' => 'jpn'
        ],
        [
            'id' => 887,
            'name' => 'Jemen',
            'alpha2' => 'ye',
            'alpha3' => 'yem'
        ],
        [
            'id' => 400,
            'name' => 'Jordanien',
            'alpha2' => 'jo',
            'alpha3' => 'jor'
        ],
        [
            'id' => 116,
            'name' => 'Kambodscha',
            'alpha2' => 'kh',
            'alpha3' => 'khm'
        ],
        [
            'id' => 120,
            'name' => 'Kamerun',
            'alpha2' => 'cm',
            'alpha3' => 'cmr'
        ],
        [
            'id' => 124,
            'name' => 'Kanada',
            'alpha2' => 'ca',
            'alpha3' => 'can'
        ],
        [
            'id' => 132,
            'name' => 'Kap Verde',
            'alpha2' => 'cv',
            'alpha3' => 'cpv'
        ],
        [
            'id' => 398,
            'name' => 'Kasachstan',
            'alpha2' => 'kz',
            'alpha3' => 'kaz'
        ],
        [
            'id' => 634,
            'name' => 'Katar',
            'alpha2' => 'qa',
            'alpha3' => 'qat'
        ],
        [
            'id' => 404,
            'name' => 'Kenia',
            'alpha2' => 'ke',
            'alpha3' => 'ken'
        ],
        [
            'id' => 417,
            'name' => 'Kirgisistan',
            'alpha2' => 'kg',
            'alpha3' => 'kgz'
        ],
        [
            'id' => 296,
            'name' => 'Kiribati',
            'alpha2' => 'ki',
            'alpha3' => 'kir'
        ],
        [
            'id' => 170,
            'name' => 'Kolumbien',
            'alpha2' => 'co',
            'alpha3' => 'col'
        ],
        [
            'id' => 174,
            'name' => 'Komoren',
            'alpha2' => 'km',
            'alpha3' => 'com'
        ],
        [
            'id' => 180,
            'name' => 'Kongo, Demokratische Republik',
            'alpha2' => 'cd',
            'alpha3' => 'cod'
        ],
        [
            'id' => 178,
            'name' => 'Kongo, Republik',
            'alpha2' => 'cg',
            'alpha3' => 'cog'
        ],
        [
            'id' => 408,
            'name' => 'Korea, Nord',
            'alpha2' => 'kp',
            'alpha3' => 'prk'
        ],
        [
            'id' => 410,
            'name' => 'Korea, Süd',
            'alpha2' => 'kr',
            'alpha3' => 'kor'
        ],
        [
            'id' => 191,
            'name' => 'Kroatien',
            'alpha2' => 'hr',
            'alpha3' => 'hrv'
        ],
        [
            'id' => 192,
            'name' => 'Kuba',
            'alpha2' => 'cu',
            'alpha3' => 'cub'
        ],
        [
            'id' => 414,
            'name' => 'Kuwait',
            'alpha2' => 'kw',
            'alpha3' => 'kwt'
        ],
        [
            'id' => 418,
            'name' => 'Laos',
            'alpha2' => 'la',
            'alpha3' => 'lao'
        ],
        [
            'id' => 426,
            'name' => 'Lesotho',
            'alpha2' => 'ls',
            'alpha3' => 'lso'
        ],
        [
            'id' => 428,
            'name' => 'Lettland',
            'alpha2' => 'lv',
            'alpha3' => 'lva'
        ],
        [
            'id' => 422,
            'name' => 'Libanon',
            'alpha2' => 'lb',
            'alpha3' => 'lbn'
        ],
        [
            'id' => 430,
            'name' => 'Liberia',
            'alpha2' => 'lr',
            'alpha3' => 'lbr'
        ],
        [
            'id' => 434,
            'name' => 'Libyen',
            'alpha2' => 'ly',
            'alpha3' => 'lby'
        ],
        [
            'id' => 438,
            'name' => 'Liechtenstein',
            'alpha2' => 'li',
            'alpha3' => 'lie'
        ],
        [
            'id' => 440,
            'name' => 'Litauen',
            'alpha2' => 'lt',
            'alpha3' => 'ltu'
        ],
        [
            'id' => 442,
            'name' => 'Luxemburg',
            'alpha2' => 'lu',
            'alpha3' => 'lux'
        ],
        [
            'id' => 450,
            'name' => 'Madagaskar',
            'alpha2' => 'mg',
            'alpha3' => 'mdg'
        ],
        [
            'id' => 454,
            'name' => 'Malawi',
            'alpha2' => 'mw',
            'alpha3' => 'mwi'
        ],
        [
            'id' => 458,
            'name' => 'Malaysia',
            'alpha2' => 'my',
            'alpha3' => 'mys'
        ],
        [
            'id' => 462,
            'name' => 'Malediven',
            'alpha2' => 'mv',
            'alpha3' => 'mdv'
        ],
        [
            'id' => 466,
            'name' => 'Mali',
            'alpha2' => 'ml',
            'alpha3' => 'mli'
        ],
        [
            'id' => 470,
            'name' => 'Malta',
            'alpha2' => 'mt',
            'alpha3' => 'mlt'
        ],
        [
            'id' => 504,
            'name' => 'Marokko',
            'alpha2' => 'ma',
            'alpha3' => 'mar'
        ],
        [
            'id' => 584,
            'name' => 'Marshallinseln',
            'alpha2' => 'mh',
            'alpha3' => 'mhl'
        ],
        [
            'id' => 478,
            'name' => 'Mauretanien',
            'alpha2' => 'mr',
            'alpha3' => 'mrt'
        ],
        [
            'id' => 480,
            'name' => 'Mauritius',
            'alpha2' => 'mu',
            'alpha3' => 'mus'
        ],
        [
            'id' => 484,
            'name' => 'Mexiko',
            'alpha2' => 'mx',
            'alpha3' => 'mex'
        ],
        [
            'id' => 583,
            'name' => 'Mikronesien',
            'alpha2' => 'fm',
            'alpha3' => 'fsm'
        ],
        [
            'id' => 498,
            'name' => 'Moldau',
            'alpha2' => 'md',
            'alpha3' => 'mda'
        ],
        [
            'id' => 492,
            'name' => 'Monaco',
            'alpha2' => 'mc',
            'alpha3' => 'mco'
        ],
        [
            'id' => 496,
            'name' => 'Mongolei',
            'alpha2' => 'mn',
            'alpha3' => 'mng'
        ],
        [
            'id' => 499,
            'name' => 'Montenegro',
            'alpha2' => 'me',
            'alpha3' => 'mne'
        ],
        [
            'id' => 508,
            'name' => 'Mosambik',
            'alpha2' => 'mz',
            'alpha3' => 'moz'
        ],
        [
            'id' => 104,
            'name' => 'Myanmar',
            'alpha2' => 'mm',
            'alpha3' => 'mmr'
        ],
        [
            'id' => 516,
            'name' => 'Namibia',
            'alpha2' => 'na',
            'alpha3' => 'nam'
        ],
        [
            'id' => 520,
            'name' => 'Nauru',
            'alpha2' => 'nr',
            'alpha3' => 'nru'
        ],
        [
            'id' => 524,
            'name' => 'Nepal',
            'alpha2' => 'np',
            'alpha3' => 'npl'
        ],
        [
            'id' => 554,
            'name' => 'Neuseeland',
            'alpha2' => 'nz',
            'alpha3' => 'nzl'
        ],
        [
            'id' => 558,
            'name' => 'Nicaragua',
            'alpha2' => 'ni',
            'alpha3' => 'nic'
        ],
        [
            'id' => 528,
            'name' => 'Niederlande',
            'alpha2' => 'nl',
            'alpha3' => 'nld'
        ],
        [
            'id' => 562,
            'name' => 'Niger',
            'alpha2' => 'ne',
            'alpha3' => 'ner'
        ],
        [
            'id' => 566,
            'name' => 'Nigeria',
            'alpha2' => 'ng',
            'alpha3' => 'nga'
        ],
        [
            'id' => 807,
            'name' => 'Nordmazedonien',
            'alpha2' => 'mk',
            'alpha3' => 'mkd'
        ],
        [
            'id' => 578,
            'name' => 'Norwegen',
            'alpha2' => 'no',
            'alpha3' => 'nor'
        ],
        [
            'id' => 512,
            'name' => 'Oman',
            'alpha2' => 'om',
            'alpha3' => 'omn'
        ],
        [
            'id' => 40,
            'name' => 'Österreich',
            'alpha2' => 'at',
            'alpha3' => 'aut'
        ],
        [
            'id' => 626,
            'name' => 'Osttimor',
            'alpha2' => 'tl',
            'alpha3' => 'tls'
        ],
        [
            'id' => 586,
            'name' => 'Pakistan',
            'alpha2' => 'pk',
            'alpha3' => 'pak'
        ],
        [
            'id' => 585,
            'name' => 'Palau',
            'alpha2' => 'pw',
            'alpha3' => 'plw'
        ],
        [
            'id' => 591,
            'name' => 'Panama',
            'alpha2' => 'pa',
            'alpha3' => 'pan'
        ],
        [
            'id' => 598,
            'name' => 'Papua-Neuguinea',
            'alpha2' => 'pg',
            'alpha3' => 'png'
        ],
        [
            'id' => 600,
            'name' => 'Paraguay',
            'alpha2' => 'py',
            'alpha3' => 'pry'
        ],
        [
            'id' => 604,
            'name' => 'Peru',
            'alpha2' => 'pe',
            'alpha3' => 'per'
        ],
        [
            'id' => 608,
            'name' => 'Philippinen',
            'alpha2' => 'ph',
            'alpha3' => 'phl'
        ],
        [
            'id' => 616,
            'name' => 'Polen',
            'alpha2' => 'pl',
            'alpha3' => 'pol'
        ],
        [
            'id' => 620,
            'name' => 'Portugal',
            'alpha2' => 'pt',
            'alpha3' => 'prt'
        ],
        [
            'id' => 646,
            'name' => 'Ruanda',
            'alpha2' => 'rw',
            'alpha3' => 'rwa'
        ],
        [
            'id' => 642,
            'name' => 'Rumänien',
            'alpha2' => 'ro',
            'alpha3' => 'rou'
        ],
        [
            'id' => 643,
            'name' => 'Russland',
            'alpha2' => 'ru',
            'alpha3' => 'rus'
        ],
        [
            'id' => 90,
            'name' => 'Salomonen',
            'alpha2' => 'sb',
            'alpha3' => 'slb'
        ],
        [
            'id' => 894,
            'name' => 'Sambia',
            'alpha2' => 'zm',
            'alpha3' => 'zmb'
        ],
        [
            'id' => 882,
            'name' => 'Samoa',
            'alpha2' => 'ws',
            'alpha3' => 'wsm'
        ],
        [
            'id' => 674,
            'name' => 'San Marino',
            'alpha2' => 'sm',
            'alpha3' => 'smr'
        ],
        [
            'id' => 678,
            'name' => 'São Tomé und Príncipe',
            'alpha2' => 'st',
            'alpha3' => 'stp'
        ],
        [
            'id' => 682,
            'name' => 'Saudi-Arabien',
            'alpha2' => 'sa',
            'alpha3' => 'sau'
        ],
        [
            'id' => 752,
            'name' => 'Schweden',
            'alpha2' => 'se',
            'alpha3' => 'swe'
        ],
        [
            'id' => 756,
            'name' => 'Schweiz',
            'alpha2' => 'ch',
            'alpha3' => 'che'
        ],
        [
            'id' => 686,
            'name' => 'Senegal',
            'alpha2' => 'sn',
            'alpha3' => 'sen'
        ],
        [
            'id' => 688,
            'name' => 'Serbien',
            'alpha2' => 'rs',
            'alpha3' => 'srb'
        ],
        [
            'id' => 690,
            'name' => 'Seychellen',
            'alpha2' => 'sc',
            'alpha3' => 'syc'
        ],
        [
            'id' => 694,
            'name' => 'Sierra Leone',
            'alpha2' => 'sl',
            'alpha3' => 'sle'
        ],
        [
            'id' => 716,
            'name' => 'Simbabwe',
            'alpha2' => 'zw',
            'alpha3' => 'zwe'
        ],
        [
            'id' => 702,
            'name' => 'Singapur',
            'alpha2' => 'sg',
            'alpha3' => 'sgp'
        ],
        [
            'id' => 703,
            'name' => 'Slowakei',
            'alpha2' => 'sk',
            'alpha3' => 'svk'
        ],
        [
            'id' => 705,
            'name' => 'Slowenien',
            'alpha2' => 'si',
            'alpha3' => 'svn'
        ],
        [
            'id' => 706,
            'name' => 'Somalia',
            'alpha2' => 'so',
            'alpha3' => 'som'
        ],
        [
            'id' => 724,
            'name' => 'Spanien',
            'alpha2' => 'es',
            'alpha3' => 'esp'
        ],
        [
            'id' => 144,
            'name' => 'Sri Lanka',
            'alpha2' => 'lk',
            'alpha3' => 'lka'
        ],
        [
            'id' => 659,
            'name' => 'St. Kitts und Nevis',
            'alpha2' => 'kn',
            'alpha3' => 'kna'
        ],
        [
            'id' => 662,
            'name' => 'St. Lucia',
            'alpha2' => 'lc',
            'alpha3' => 'lca'
        ],
        [
            'id' => 670,
            'name' => 'St. Vincent und die Grenadinen',
            'alpha2' => 'vc',
            'alpha3' => 'vct'
        ],
        [
            'id' => 710,
            'name' => 'Südafrika',
            'alpha2' => 'za',
            'alpha3' => 'zaf'
        ],
        [
            'id' => 729,
            'name' => 'Sudan',
            'alpha2' => 'sd',
            'alpha3' => 'sdn'
        ],
        [
            'id' => 728,
            'name' => 'Südsudan',
            'alpha2' => 'ss',
            'alpha3' => 'ssd'
        ],
        [
            'id' => 740,
            'name' => 'Suriname',
            'alpha2' => 'sr',
            'alpha3' => 'sur'
        ],
        [
            'id' => 760,
            'name' => 'Syrien',
            'alpha2' => 'sy',
            'alpha3' => 'syr'
        ],
        [
            'id' => 762,
            'name' => 'Tadschikistan',
            'alpha2' => 'tj',
            'alpha3' => 'tjk'
        ],
        [
            'id' => 834,
            'name' => 'Tansania',
            'alpha2' => 'tz',
            'alpha3' => 'tza'
        ],
        [
            'id' => 764,
            'name' => 'Thailand',
            'alpha2' => 'th',
            'alpha3' => 'tha'
        ],
        [
            'id' => 768,
            'name' => 'Togo',
            'alpha2' => 'tg',
            'alpha3' => 'tgo'
        ],
        [
            'id' => 776,
            'name' => 'Tonga',
            'alpha2' => 'to',
            'alpha3' => 'ton'
        ],
        [
            'id' => 780,
            'name' => 'Trinidad und Tobago',
            'alpha2' => 'tt',
            'alpha3' => 'tto'
        ],
        [
            'id' => 148,
            'name' => 'Tschad',
            'alpha2' => 'td',
            'alpha3' => 'tcd'
        ],
        [
            'id' => 203,
            'name' => 'Tschechien',
            'alpha2' => 'cz',
            'alpha3' => 'cze'
        ],
        [
            'id' => 788,
            'name' => 'Tunesien',
            'alpha2' => 'tn',
            'alpha3' => 'tun'
        ],
        [
            'id' => 792,
            'name' => 'Türkei',
            'alpha2' => 'tr',
            'alpha3' => 'tur'
        ],
        [
            'id' => 795,
            'name' => 'Turkmenistan',
            'alpha2' => 'tm',
            'alpha3' => 'tkm'
        ],
        [
            'id' => 798,
            'name' => 'Tuvalu',
            'alpha2' => 'tv',
            'alpha3' => 'tuv'
        ],
        [
            'id' => 800,
            'name' => 'Uganda',
            'alpha2' => 'ug',
            'alpha3' => 'uga'
        ],
        [
            'id' => 804,
            'name' => 'Ukraine',
            'alpha2' => 'ua',
            'alpha3' => 'ukr'
        ],
        [
            'id' => 348,
            'name' => 'Ungarn',
            'alpha2' => 'hu',
            'alpha3' => 'hun'
        ],
        [
            'id' => 858,
            'name' => 'Uruguay',
            'alpha2' => 'uy',
            'alpha3' => 'ury'
        ],
        [
            'id' => 860,
            'name' => 'Usbekistan',
            'alpha2' => 'uz',
            'alpha3' => 'uzb'
        ],
        [
            'id' => 548,
            'name' => 'Vanuatu',
            'alpha2' => 'vu',
            'alpha3' => 'vut'
        ],
        [
            'id' => 862,
            'name' => 'Venezuela',
            'alpha2' => 've',
            'alpha3' => 'ven'
        ],
        [
            'id' => 784,
            'name' => 'Vereinigte Arabische Emirate',
            'alpha2' => 'ae',
            'alpha3' => 'are'
        ],
        [
            'id' => 840,
            'name' => 'Vereinigte Staaten',
            'alpha2' => 'us',
            'alpha3' => 'usa'
        ],
        [
            'id' => 826,
            'name' => 'Vereinigtes Königreich',
            'alpha2' => 'gb',
            'alpha3' => 'gbr'
        ],
        [
            'id' => 704,
            'name' => 'Vietnam',
            'alpha2' => 'vn',
            'alpha3' => 'vnm'
        ],
        [
            'id' => 140,
            'name' => 'Zentral­afrikanische Republik',
            'alpha2' => 'cf',
            'alpha3' => 'caf'
        ],
        [
            'id' => 196,
            'name' => 'Zypern',
            'alpha2' => 'cy',
            'alpha3' => 'cyp'
        ],
    ];

    /**
     * Ländernamen für das Alpha2 Kürzel abrufen.
     *
     * @param string $alpha2
     *
     * @return array
     */
    public static function getCountryFromAlpha2 (string $alpha2): array
    {
        /**
         * $alpha2 in Kleinbuchstaben umwandeln, damit sowohl bspw. at als auch AT funktionieren.
         */
        $alpha2 = strtolower($alpha2);

        /**
         * Die array_filter()-Funktion kann einen Array mittels einer Callback Funktion filtern. Diese Callback Funktion
         * muss true zurückgeben, wenn ein Element in die gefilterte Ausgabe aufgenommen werden soll.
         *
         * Hier ist wichtig zu beachten, dass die Callback Funktion eine anonyme Funktion ist und daher ein 'use (...)'
         * benötigt, damit die $alpha2 Variable in den Scope der anonymen Funktion aufgenommen wird.
         *
         * Die Callback-Funktion wird auf jedes Element in dem zu filternden Array angewendet und sollte daher möglichst
         * einfach und effizient sein.
         */
        return array_filter(self::COUNTRIES, function ($country) use ($alpha2) {
            /**
             * Stimmt der $alpha2 Code überein, so geben wir true zurück und nehmen das aktuelle Element daher in das
             * Filterergebnis auf.
             */
            if ($country['alpha2'] === $alpha2) {
                return true;
            }
        });
    }
}