/***
 *
 * @param selector
 * @returns {Element}
 * @private
 */
function _1(selector) {
    return document.querySelector(selector);
}

/***
 *
 * @param selector
 * @returns {NodeListOf<Element>}
 * @private
 */
function _n(selector) {
    return document.querySelectorAll(selector);
}
