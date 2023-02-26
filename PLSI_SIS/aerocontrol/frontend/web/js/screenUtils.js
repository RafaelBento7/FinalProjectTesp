// As medias querys que estou a utilizar no css
// 40em
const SMALL_MEDIA_QUERY = 640;
// 60em
const MEDIUM_MEDIA_QUERY = 960;
// 70em
const LARGE_MEDIA_QUERY = 1120;

// Exceções
const FLIGHT_RESERVE_PASSENGERS_LIST_MEDIA_QUERY = 760;

let screenWidth = window.innerWidth;

window.addEventListener('resize', function () {
    screenWidth = this.innerWidth;
})


function isScreenWidthHigherThan(widthToCompare) {
    return screenWidth > widthToCompare;
}

export { SMALL_MEDIA_QUERY, MEDIUM_MEDIA_QUERY, LARGE_MEDIA_QUERY, FLIGHT_RESERVE_PASSENGERS_LIST_MEDIA_QUERY };
export { isScreenWidthHigherThan, screenWidth };