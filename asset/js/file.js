let autre=document.querySelector("#autre")
let mois=document.querySelector("#mois")
let frais=document.querySelector("#frais-mensuel")
let motif=document.querySelector("#motif")
frais.addEventListener("click", function (){
    if(frais.checked){
        mois.classList.remove("d-none")
        mois.setAttribute("name","mois")
        motif.value="FRAIS MENSUEL"
    }
})
autre.addEventListener("click",function (){
    if(autre.checked){
        mois.classList.add("d-none")
        mois.removeAttribute("name")
        motif.value=""
    }
})
