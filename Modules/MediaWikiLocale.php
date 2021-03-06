<?php
namespace LanguageTag\Modules;

use LanguageTag\LanguageTag;

/**
 * Ported from http://www.mediawiki.org/w/index.php?title=Template:BCP47&oldid=891982
 */
class MediaWikiLocale {
    static $anomalies = array(
        /* pseudocodes */
        'default' => 'und',

        /* current BCP47 violations by Wikimedia sites, which can be fixed using standard tags when they exist */
        'als' => 'gsw',
        'bat-smg' => 'sgs',
        'fiu-vro' => 'vro',
        'roa-rup' => 'rup',
        'simple' => 'en<!-- could be "en-x-simple" but actually a subset within standard "en" for HTML -->',
        'sr-sc' => 'sr-cyrl',
        'sr-sl' => 'sr-latn',
        'zh-classical' => 'lzh',

        /* other current BCP47 violations by Wikimedia sites, fixed using private-use extensions (if they are needed, labels are limited to 8 letters/digits) */
        'cbk-zam' => 'cbk-x-zam',
        'de-formal' => 'de', /* could be "de-x-formal", but actually a subset within standard "de" for HTML/XML */
        'eml' => 'it-x-eml', /* retired code, two competing standard codes for these Emilian variants of Italian */
        'map-bms' => 'map-x-bms',
        'mo' => 'ro-cyrl', /* retired, best fit on Wikimedia sites, but no longer working in interwikis (Wikipedia project locked down) */
        'nl-informal' => 'nl', /* could be "nl-x-informal", but actually a subset within standard "nl" for HTML/XML */
        'nrm' => 'fr-x-nrm', /* could be roa-x-nrm using a family subtag, but a "private-use" extension of French is still much better for language/script fallbacks */
        'roa-tara' => 'it-x-tara',

        /* conforming BCP47 "private-use" extensions used by Wikimedia, which are no longer needed, and improved using now standard codes */
        'be-x-old' => 'be-tarask',

        /* conforming but ambiguous BCP47 codes used by Wikimedia in a more restrictive way, with more precision */
        'no' => 'nb', /* "no" means Bokmål on Wikimedia sites, "nb" is not used */
        'bh' => 'bho', /* "bh"="bih" is a language family, interpreted in Wikimedia as the single language "bho", even if its interwiki code remains bh) */
        'tgl' => 'tl-tglg', /* "tgl" on Wikimedia is the historic variant of the Tagalog macrolanguage ("tl" or "tgl", "tl" recommended for BCP47), written in the Baybayin script ("tglg") */

        /* conforming BCP47 "inherited" tags, strongly discouraged and replaced by their recommended tags (complete list that should not be augmented now) */
        'art-lojban' => 'jbo', /* still used in some old Wikimedia templates */
        'en-gb-oed' => 'en-gb', /* no preferred replacement, could be "en-gb-x-oed" but actually a subset within standard "en-gb" */
        'i-ami' => 'ami',
        'i-bnn' => 'bnn',
        'i-hak' => 'hak',
        'i-klingon' => 'tlh',
        'i-lux' => 'lb',
        'i-navajo' => 'nv',
        'i-pwn' => 'pwn',
        'i-tao' => 'tao',
        'i-tay' => 'tay',
        'i-tsu' => 'tsu',
        'no-bok' => 'nb', /* still used in some old Wikimedia templates */
        'no-nyn' => 'nn', /* still used in some old Wikimedia templates */
        'sgn-be-fr' => 'sfb',
        'sgn-be-nl' => 'vgt',
        'sgn-ch-de' => 'sgg',
        'zh-guoyu' => 'cmn', /* this could be an alias of "zh" on Wikimedia sites, which do not use "cmn" but assume "zh" is Mandarin */
        'zh-hakka' => 'hak',
        'zh-min' => 'zh-tw', /* no preferred replacement, could be "zh-x-min", but actually a subset within standard "zh-tw"; not necessarily "nan" */
        'zh-min-nan' => 'nan', /* used in some old Wikimedia templates and in interwikis */
        'zh-xiang' => 'hsn',

     /* conforming BCP47 "redundant" tags, discouraged and replaced by their recommended tags (complete list that should not be augmented now) */
        'sgn-br' => 'bzs',
        'sgn-co' => 'csn',
        'sgn-de' => 'gsg',
        'sgn-dk' => 'dsl',
        'sgn-es' => 'ssp',
        'sgn-fr' => 'fsl', /* still used in some old Wikimedia templates */
        'sgn-gb' => 'bfi',
        'sgn-gr' => 'gss',
        'sgn-ie' => 'isg',
        'sgn-it' => 'ise',
        'sgn-jp' => 'jsl',
        'sgn-mx' => 'mfs',
        'sgn-ni' => 'ncs',
        'sgn-nl' => 'dse',
        'sgn-no' => 'nsl',
        'sgn-pt' => 'psr',
        'sgn-se' => 'swl',
        'sgn-us' => 'ase', /* still used in some old Wikimedia templates */
        'sgn-za' => 'sfs',
        'zh-cmn' => 'cmn', /* still used in some old Wikimedia templates, this could be an alias of "zh" on Wikimedia sites, which do not use "cmn" but assume "zh" is Mandarin */
        'zh-cmn-Hans' => 'cmn-hans', /* still used in some old Wikimedia templates, this could be an alias of "zh-hans" on Wikimedia sites, which do not use "cmn" but assume "zh" is Mandarin */
        'zh-cmn-Hant' => 'cmn-hant', /* still used in some old Wikimedia templates, this could be an alias of "zh-hant" on Wikimedia sites, which do not use "cmn" but assume "zh" is Mandarin */
        'zh-gan' => 'gan', /* still used in some old Wikimedia templates */
        'zh-wuu' => 'wuu', /* still used in some old Wikimedia templates */
        'zh-yue' => 'yue', /* still used in some old Wikimedia templates and in interwikis */

        /* other "inherited" tags of the standard, strongly discouraged as they are deleted, but with no defined replacement there are left unaffected (complete list that should not be augmented now) */
        'cel-gaulish' => 'cel-x-gaulish?',
        'i-default' => 'und-x-default?', /* still used in some old Wikimedia templates and in interwikis */
        'i-enochian' => 'x-enochian?',
        'i-mingo' => 'x-mingo?',
    );

    static $mediawikiSupportedLanguages = array(
        'ab',
        'ace',
        'aeb',
        'af',
        'ak',
        'aln',
        'am',
        'ang',
        'an',
        'anp',
        'arc',
        'arn',
        'ar',
        'ary',
        'arz',
        'as',
        'ast',
        'avk',
        'av',
        'ay',
        'azb',
        'az',
        'ba',
        'bar',
        'bbc-latn',
        'bbc',
        'bcc',
        'bcl',
        'be',
        'be-tarask',
        'bg',
        'bho',
        'bh',
        'bi',
        'bjn',
        'bm',
        'bn',
        'bo',
        'bpy',
        'bqi',
        'brh',
        'br',
        'bs',
        'bug',
        'bxr',
        'ca',
        'cbk-zam',
        'cdo',
        'ceb',
        'ce',
        'ch',
        'chr',
        'ckb',
        'co',
        'cps',
        'crh-cyrl',
        'crh-latn',
        'crh',
        'csb',
        'cs',
        'cu',
        'cv',
        'cy',
        'da',
        'de-at',
        'de-ch',
        'de-formal',
        'de',
        'diq',
        'dsb',
        'dtp',
        'dv',
        'dz',
        'ee',
        'egl',
        'el',
        'eml',
        'en-ca',
        'en-gb',
        'en',
        'en-rtl',
        'eo',
        'es',
        'et',
        'eu',
        'ext',
        'fa',
        'ff',
        'fi',
        'fit',
        'fj',
        'fo',
        'frc',
        'fr',
        'frp',
        'frr',
        'fur',
        'fy',
        'gag',
        'gan-hans',
        'gan-hant',
        'gan',
        'ga',
        'gd',
        'glk',
        'gl',
        'gn',
        'gom-latn',
        'got',
        'grc',
        'gsw',
        'gu',
        'gv',
        'hak',
        'ha',
        'haw',
        'he',
        'hif-latn',
        'hif',
        'hil',
        'hi',
        'hr',
        'hsb',
        'ht',
        'hu',
        'hy',
        'ia',
        'id',
        'ie',
        'ig',
        'ii',
        'ike-cans',
        'ike-latn',
        'ik',
        'ilo',
        'inh',
        'io',
        'is',
        'it',
        'iu',
        'jam',
        'ja',
        'jbo',
        'jut',
        'jv',
        'kaa',
        'kab',
        'ka',
        'kbd-cyrl',
        'kbd',
        'kg',
        'khw',
        'kiu',
        'kk-arab',
        'kk-cn',
        'kk-cyrl',
        'kk-kz',
        'kk-latn',
        'kk',
        'kk-tr',
        'kl',
        'km',
        'kn',
        'koi',
        'ko-kp',
        'ko',
        'krc',
        'kri',
        'krj',
        'ks-arab',
        'ks-deva',
        'ksh',
        'ks',
        'ku-arab',
        'ku-latn',
        'ku',
        'kv',
        'kw',
        'ky',
        'lad',
        'la',
        'lbe',
        'lb',
        'lez',
        'lfn',
        'lg',
        'lij',
        'li',
        'liv',
        'lmo',
        'ln',
        'lo',
        'loz',
        'lrc',
        'ltg',
        'lt',
        'lus',
        'lv',
        'lzh',
        'lzz',
        'mai',
        'map-bms',
        'mdf',
        'mg',
        'mhr',
        'min',
        'mi',
        'mk',
        'ml',
        'mn',
        'mo',
        'mrj',
        'mr',
        'ms',
        'mt',
        'mwl',
        'my',
        'myv',
        'mzn',
        'nah',
        'nan',
        'na',
        'nap',
        'nb',
        'nds-nl',
        'nds',
        'ne',
        'new',
        'niu',
        'nl-informal',
        'nl',
        'nn',
        'nov',
        'nso',
        'nv',
        'ny',
        'oc',
        'om',
        'or',
        'os',
        'pag',
        'pam',
        'pa',
        'pap',
        'pcd',
        'pdc',
        'pdt',
        'pfl',
        'pih',
        'pi',
        'pl',
        'pms',
        'pnb',
        'pnt',
        'prg',
        'ps',
        'pt-br',
        'pt',
        'qqq',
        'qug',
        'qu',
        'rgn',
        'rif',
        'rm',
        'rmy',
        'roa-tara',
        'ro',
        'rue',
        'ru',
        'rup',
        'ruq-cyrl',
        'ruq-latn',
        'ruq',
        'sah',
        'sa',
        'sat',
        'scn',
        'sco',
        'sc',
        'sdc',
        'sd',
        'sei',
        'se',
        'sg',
        'sgs',
        'shi',
        'sh',
        'si',
        'sk',
        'sli',
        'sl',
        'sma',
        'sm',
        'sn',
        'so',
        'sq',
        'sr-ec',
        'sr-el',
        'srn',
        'sr',
        'ss',
        'st',
        'stq',
        'su',
        'sv',
        'sw',
        'szl',
        'ta',
        'tcy',
        'te',
        'tet',
        'tg-cyrl',
        'tg-latn',
        'tg',
        'th',
        'ti',
        'tk',
        'tl',
        'tly',
        'tn',
        'tokipona',
        'to',
        'tpi',
        'tr',
        'tru',
        'ts',
        'tt-cyrl',
        'tt-latn',
        'tt',
        'ty',
        'tyv',
        'udm',
        'ug-arab',
        'ug-latn',
        'ug',
        'uk',
        'ur',
        'uz',
        'vec',
        've',
        'vep',
        'vi',
        'vls',
        'vmf',
        'vo',
        'vot',
        'vro',
        'wa',
        'war',
        'wo',
        'wuu',
        'xal',
        'xh',
        'xmf',
        'yi',
        'yo',
        'yue',
        'za',
        'zea',
        'zh-cn',
        'zh-hans',
        'zh-hant',
        'zh-hk',
        'zh-mo',
        'zh-my',
        'zh',
        'zh-sg',
        'zh-tw',
        'zu',
    );

    function preprocess(&$raw) {
        if (array_key_exists($raw, MediaWikiLocale::$anomalies)) {
            $raw = MediaWikiLocale::$anomalies[$raw];
        }
    }

    static function getMediaWikiLanguageCode($canonical) {
        return LanguageTag::lookupBestLang($canonical, MediaWikiLocale::$mediawikiSupportedLanguages);
    }

    static function getMediaWikiProjectCode($locale) {
        throw new Exception(__FUNCTION__ . " not implemented.");
    }
}
