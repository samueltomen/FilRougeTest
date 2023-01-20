const activeLink = (e)=>{
    const id = e.target.id
    const idArray = ["1","2","3"]

    idArray.forEach((element)=> {
        document.getElementById(element).classList.remove("active")
    });
    document.getElementById(id).classList.add("active")
}


// Scroll Animation
window.addEventListener('scroll', checkBoxes)

checkBoxes()

function checkBoxes (){
  const boxes = document.querySelectorAll('.box')
  const triggerBottom = (window.innerHeight / 9 * 8 )
  boxes.forEach(box => {

    const boxTop = box.getBoundingClientRect().top

    if(boxTop < triggerBottom){
      box.classList.add('show');
    }else{
      box.classList.remove('show')
    }
  })
}

// On load animation


function effectLoadScreen(){

    const loadScreen = document.querySelectorAll('.screenLoad')
    const loadAnimation = (e)=>{
      const id = e.target.id
      const idArray = ["h1","p1"]
  
      idArray.forEach((element)=> {
          document.getElementById(element).classList.remove("loading")
      });
      document.getElementById(id).classList.add("loading")
  }

  
  }

  function activeCardsNosProjets() {
    const id = 2;
    const idArray = ["1","2","3"];
    window.scroll(0,0);
  
    idArray.forEach((element)=> {
        document.getElementById(element).classList.remove("active");
    });
    document.getElementById(id).classList.add("active");
  }

  // Scroll Animation


// window.addEventListener('load', screenLoad)

// function screenLoad (){
//   const boxes = document.querySelectorAll('.screenLoad')
//   const triggerBottom = window.innerHeight/1*1
//   boxes.forEach(box => {

//     const boxTop = box.getBoundingClientRect().top

//     if(boxTop < triggerBottom){
//       box.classList.add('loading');
//     }else{
//       box.classList.remove('loading');
//     }
//   })
// }

//////////////////////////////// Boutton retour en haut de la page ///////////////////////


