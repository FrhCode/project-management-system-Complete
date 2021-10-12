import * as func from "./func.js";
export function init(input, target, ignoreZero) {
    input.keyup(function (e) {
        if (ignoreZero == undefined) {
            if ($(this).val().charAt(0) === '0')
                return $(this).val('');

        }
        else {
            if ($(this).val().charAt(0) === '0' && $(this).val().charAt(1) === '0')
                return $(this).val('0')
        }

        let num = $(this).val().replace(/[^0-9]+/g, '');
        $(this).val(func.numWithComma(num));
        target.val(num);
    });
}
