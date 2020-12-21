const select = dom => document.querySelector(dom)
const selectAll = dom => document.querySelectorAll(dom)

const scrollKe = dom => {
    select(dom).scrollIntoView({
        behavior: 'smooth'
    })
}

const post = (url, data) => {
    let payload = {
        method: 'POST',
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify(data)
    }
    if (data.csrfToken) {
        payload['headers']["X-CSRF-TOKEN"] = data.csrfToken
    }
    return fetch(url, payload)
    .then(res => res.json())
}
const get = url => {
    return fetch(url)
    .then(res => res.json())
}

const bindDivWithImage = () => {
    const divsWithBgImg = selectAll("div[bg-image]")
    divsWithBgImg.forEach(div => {
        let bg = div.getAttribute('bg-image')
        div.style.backgroundImage = `url('${bg}')`
        div.style.backgroundPosition = 'center center'
        div.style.backgroundSize = 'cover'
    })
}
bindDivWithImage()

// alert
let alerts = selectAll('.alert .ke-kanan')
alerts.forEach(alert => {
    alert.addEventListener('click', e => {
        let parent = e.currentTarget.parentNode
        parent.style.display = "none"
    })
})

const munculPopup = sel => {
    let popup = select(sel)
    select(".bg").style.display = "block"
    popup.style.display = "block"
    // let height = popup.clientHeight
    // popup.style.marginTop = `${height}px`
    setTimeout(() => {
        select(sel + " .popup").style.top = "70px"
    }, 50)
}
const hilangPopup = (sel) => {
    select(".bg").style.display = "none"
    selectAll(sel + " .popup").forEach(res => {
        // let height = res.clientHeight + 1250
        // res.style.marginTop = `-${height}px`
    })
    // setTimeout(() => {
        selectAll(sel).forEach(res => res.style.display = "none")
    // }, 100);
}
if (select(".bg")) {
    select(".bg").addEventListener('click', e => {
        hilangPopup(".popupWrapper")
    })
}

function createElement(props) {  
    let el = document.createElement(props.el)
    if (props.attributes !== undefined) {
        props.attributes.forEach(res => {
            el.setAttribute(res[0], res[1])
        })
    }
    if(props.html !== undefined) {
        el.innerHTML = props.html
    }
    select(props.createTo).appendChild(el)
}

function toIdr(angka) {
	var rupiah = '';		
	var angkarev = angka.toString().split('').reverse().join('');
	for(var i = 0; i < angkarev.length; i++) if(i%3 == 0) rupiah += angkarev.substr(i,3)+'.';
	return 'Rp. '+rupiah.split('',rupiah.length-1).reverse().join('');
}
function toAngka(rupiah) {
    return parseInt(rupiah.replace(/,.*|[^0-9]/g, ''), 10);
}
function inArray(needle, haystack) {
    let length = haystack.length;
    for (let i = 0; i < length; i++) {
        if (haystack[i] == needle) return true;
    }
    return false;
}

const redirect = url => {
    let a = document.createElement('a')
    a.href = url
    a.setAttribute('target', '_blank')
    a.click()
}
const sum = (...args) => {
    return args.reduce((total, arg) => total + arg, 0)
}

const removeArray = (arr, toRemove) => {
	let index = arr.indexOf(toRemove)
	arr.splice(index, 1)
}

document.addEventListener('keydown', e => {
    if (e.key == "Escape") {
        hilangPopup(".popupWrapper")
    }
})

// selectAll(".box").forEach(input => {
//     input.addEventListener('focus', e => {
//         e.currentTarget.style.border = "1px solid #ddd"
//     })
// })
