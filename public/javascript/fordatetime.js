let date=document.getElementById('realdate')
            let d = new Date();
            date.innerHTML=d.toLocaleDateString();
let time=document.getElementById('realtime')
    setInterval(() => {
        let t = new Date();
        time.innerHTML = t.toLocaleTimeString();
}, 1000);