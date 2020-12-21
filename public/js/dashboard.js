let isNotifShown = false
let isMenuShown = true

const toggleNotif = () => {
    if (!isNotifShown) {
        select("#notifArea").style.display = "block"
    }else {
        select("#notifArea").style.display = "none"
    }
    isNotifShown = !isNotifShown
}
const toggleMenu = () => {
    if (!isMenuShown) {
        select("nav#menu").style.left = "0%"
        select(".container").style.left = "30%"
    }else {
        select("nav#menu").style.left = "-100%"
        select(".container").style.left = "5%"
    }
    isMenuShown = !isMenuShown
}
let width = document.body.clientWidth
if (width < 480) {
    toggleMenu()
}