let doms = selectAll("div,button,input")
doms.forEach(dom => {
    let styles = window.getComputedStyle(dom, null).cssText
    dom.setAttribute('style', styles)
})