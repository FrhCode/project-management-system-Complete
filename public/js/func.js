export function numWithComma(num) {
    return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.");
}

export function truncate(n, len) {
    var ext = n.substring(n.lastIndexOf(".") + 1, n.length).toLowerCase();
    var filename = n.replace('.' + ext, '');
    if (filename.length <= len) {
        return n;
    }
    filename = filename.substr(0, len) + (n.length > len ? '[...]' : '');
    return filename + '.' + ext;
};
export function setDateBetweenText(elem) { }
