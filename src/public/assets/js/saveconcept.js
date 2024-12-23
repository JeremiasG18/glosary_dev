if (location.href.includes("newconcept")) {

    const form = document.querySelector(".form");

    form.addEventListener("submit", (e)=>{
        e.preventDefault();
        let respuesta = window.confirm("Are you sure you save the concept?")

        if (respuesta) {
            let data = new FormData(form)
            let method=form.getAttribute("method");
            let action=form.getAttribute("action");

            let encabezados= new Headers();

            let config={
                method: method,
                headers: encabezados,
                mode: 'cors',
                cache: 'no-cache',
                body: data
            };

            fetch(action,config)
            .then(respuesta => respuesta.json())
            .then(respuesta =>{ 
                alert(respuesta.text)
                if (respuesta.text.includes("saved successfully")) {
                    window.location.href = respuesta.url;
                }
            });
            
        }

    })

}

if (location.href.includes("concepts")) {
    const imagen = document.querySelector(".imagen");
    const gallery = document.querySelector(".box_none");
    const image = document.querySelectorAll(".img")
    image.forEach(img => {
        img.addEventListener('click', ()=>{
            imagen.setAttribute("src", img.getAttribute("src"))
            gallery.classList.remove('box_none');
            gallery.classList.add('box');
        })
    })
    let button = document.querySelector('.box_none');
    button.addEventListener('click', () =>{
        gallery.classList.remove('box');
        button.classList.add("box_none");
    })
}