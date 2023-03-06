window.onload = ()=>{
    let a = document.querySelectorAll(".recette");
    let b = document.querySelectorAll(".bm");
    const preparation = document.getElementById("preparation");
    const ingredients = document.getElementById("ingredients");
    const titre = document.getElementById("title");


    b.forEach(btn=> {
        btn.addEventListener("click", ()=>{
            titre.textContent = btn.getAttribute("data-blog-title");
            preparation.textContent = btn.getAttribute("data-blog-preparation")
            ingredients.textContent = btn.getAttribute("data-blog-ingredients");
        })
    })
}

