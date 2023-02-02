// const activeLink = (e) => {
//     const id = e.target.id;
//     const idArray = ['1', '2', '3'];

//     idArray.forEach((element) => {
//         document.getElementById(element).classList.remove('active');
//     });
//     document.getElementById(id).classList.add('active');
// };

// Scroll Animation
window.addEventListener('scroll', checkBoxes);

checkBoxes();

function checkBoxes() {
    const boxes = document.querySelectorAll('.box');
    const triggerBottom = (window.innerHeight / 9) * 8;
    boxes.forEach((box) => {
        const boxTop = box.getBoundingClientRect().top;

        if (boxTop < triggerBottom) {
            box.classList.add('show');
        } else {
            box.classList.remove('show');
        }
    });
}

// On load animation

function effectLoadScreen() {
    const loadScreen = document.querySelectorAll('.screenLoad');
    const loadAnimation = (e) => {
        const id = e.target.id;
        const idArray = ['h1', 'p1'];

        idArray.forEach((element) => {
            document.getElementById(element).classList.remove('loading');
        });
        document.getElementById(id).classList.add('loading');
    };
}

function activeCardsNosProjets() {
    const id = 2;
    const idArray = ['1', '2', '3'];
    window.scroll(0, 0);

    idArray.forEach((element) => {
        document.getElementById(element).classList.remove('active');
    });
    document.getElementById(id).classList.add('active');
}

// MET EN SURBRILLANCE TOUS LES LIENS DE LA NAVBAR ACTIVE

/* const currentUrl = window.location.href;
const links = document.querySelectorAll('#navbarlink a');

links.forEach((link) => {
    if (link.href === currentUrl) {
        link.classList.add('activeLink');
    }
});

function selectLink(link) {
    links.forEach((item) => {
        if (!link.classList.contains('activeLink')) {
            item.classList.remove('activeLink');
        } else {
            link.classList.add('activeLink');
        }
    });
}
 */

// Récupère l'URL de la page courante sans les paramètres de la requête ni l'ancre
const currentUrl = window.location.href;
const links = document.querySelectorAll('#navbarlink a');

// Parcours tous les liens pour trouver le lien qui correspond à l'URL courante

links.forEach((link) => {
    if (currentUrl === true) {
        link.classList.add('activeLink');
    }
});
function selectLink(link) {
    links.forEach((item) => {
        // Vérifie si le lien actuel est celui qui a été cliqué
        if (item === link) {
            // Si oui, vérifie si le lien a déjà la classe activeLink
            if (!item.classList.contains('activeLink')) {
                // Si non, ajoute la classe activeLink
                item.classList.add('activeLink');
            }
        } else {
            // Si non, retire la classe activeLink
            item.classList.remove('activeLink');
        }
    });
}
//////////////////////////////// Boutton retour en haut de la page ///////////////////////

window.onscroll = function() {
    scrollFunction()
  };
  
  function scrollFunction() {
    if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20 ) {
      document.getElementById("topBtn").style.display = "block";
    } else {
      document.getElementById("topBtn").style.display = "none";
    }
  }
  
  // When the user clicks on the button, scroll to the top of the document
  function topFunction() {
    document.body.scrollTop = 0; // For Safari
    document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
  }
  
  document.getElementById("topBtn").addEventListener("click", topFunction);
