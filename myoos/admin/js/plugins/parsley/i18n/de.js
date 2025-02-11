/*!
* Parsleyjs
* Guillaume Potier - <guillaume@wisembly.com>
* Version 2.2.0-rc2 - built Tue Oct 06 2015 10:20:13
* MIT Licensed
*
*/
!(function (factory) {
    if (typeof define === 'function' && define.amd) {
        // AMD. Register as an anonymous module depending on jQuery.
        define(['jquery'], factory);
    } else if (typeof exports === 'object') {
        // Node/CommonJS
        module.exports = factory(require('jquery'));
    } else {
        // Register plugin with global jQuery object.
        factory(jQuery);
    }
}(function ($) {
    // small hack for requirejs if jquery is loaded through map and not path
    // see http://requirejs.org/docs/jquery.html
    if ('undefined' === typeof $ && 'undefined' !== typeof window.jQuery) {
        $ = window.jQuery;
    }
    // ParsleyConfig definition if not already set
    window.ParsleyConfig = window.ParsleyConfig || {};
    window.ParsleyConfig.i18n = window.ParsleyConfig.i18n || {};
    // Define then the messages
    window.ParsleyConfig.i18n.de = jQuery.extend(
        window.ParsleyConfig.i18n.de || {}, {
            defaultMessage: "Die Eingabe scheint nicht korrekt zu sein.",
            type: {
                email:        "Die Eingabe muss eine gültige E-Mail-Adresse sein.",
                url:          "Die Eingabe muss eine gültige URL sein.",
                number:       "Die Eingabe muss eine Zahl sein.",
                integer:      "Die Eingabe muss eine Zahl sein.",
                digits:       "Die Eingabe darf nur Ziffern enthalten.",
                alphanum:     "Die Eingabe muss alphanumerisch sein."
            },
            notblank:       "Die Eingabe darf nicht leer sein.",
            required:       "Dies ist ein Pflichtfeld.",
            pattern:        "Die Eingabe scheint ungültig zu sein.",
            min:            "Die Eingabe muss größer oder gleich %s sein.",
            max:            "Die Eingabe muss kleiner oder gleich %s sein.",
            range:          "Die Eingabe muss zwischen %s und %s liegen.",
            minlength:      "Die Eingabe ist zu kurz. Es müssen mindestens %s Zeichen eingegeben werden.",
            maxlength:      "Die Eingabe ist zu lang. Es dürfen höchstens %s Zeichen eingegeben werden.",
            length:         "Die Länge der Eingabe ist ungültig. Es müssen zwischen %s und %s Zeichen eingegeben werden.",
            mincheck:       "Wählen Sie mindestens %s Angaben aus.",
            maxcheck:       "Wählen Sie maximal %s Angaben aus.",
            check:          "Wählen Sie zwischen %s und %s Angaben.",
            equalto:        "Dieses Feld muss dem anderen entsprechen."
        }
    );
    // If file is loaded after Parsley main file, auto-load locale
    if ('undefined' !== typeof window.ParsleyValidator) {
        window.ParsleyValidator.addCatalog('de', window.ParsleyConfig.i18n.de, true);
    }
}));