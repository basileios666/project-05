// hide and show full Description

let button = document.getElementsByClassName("seemore")
let less = document.querySelectorAll('.product-description') 
let more = document.querySelectorAll('.full_description') 
for (let index = 0; index < button.length; index++) {
    button[index].onclick = function fullDescription(){
            if(this.innerHTML == 'See more'){
            this.innerHTML = "See less"
            less[index].style.display = "none";
            more[index].style.display = "block";
        }else{
            this.innerHTML = "See more"
            less[index].style.display = "block";
            more[index].style.display = "none";
        }
    }
}





// hide and show sub categories

let subCat = document.querySelectorAll('.submenus');
let subCatLi = document.querySelectorAll('ul.submenu');
let expand = document.querySelector('.fa-circle-plus');
let mainMenu = document.querySelectorAll('.jquery-accordion-menu > ul')
let active = document.querySelectorAll('.jquery-accordion-menu > li')
for(let i = 0 ; i<subCat.length ; i++){
subCat[i].onclick = function submenu(){ 
    if (!(subCat[i].classList.contains('expanded'))) {
        subCatLi[i].style.display='block'
        subCat[i].classList.add('expanded')
        subCat[i].classList.remove('fa-circle-plus')
        subCat[i].classList.add('fa-minus')
        active[i].classList.add('active')
    }else{
        subCatLi[i].style.display='none'
        subCat[i].classList.remove('expanded')
        subCat[i].classList.add('fa-circle-plus')
        subCat[i].classList.remove('fa-minus')
        active[i].classList.remove('active')
    }
}
}



