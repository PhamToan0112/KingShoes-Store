window.addEventListener('scroll', function () {
    var header = document.querySelector('.scroll-window');

    if (window.scrollY > 100) {
        header.classList.add('fixed');
    } else {
        header.classList.remove('fixed');
    }
});
var modal = document.getElementById('id01');
window.onclick = function (event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}

// ==============SWIPER===========
document.addEventListener("DOMContentLoaded", function() {
    var imgFeature = document.querySelector('.img-feature');
    var listImg = document.querySelectorAll('.list-image img');
    var currentIndex = 0;

    function updateImagebyIndex(index) {
        console.log("Updating image to index:", index);
        document.querySelectorAll('.list-image div').forEach(item => {
            item.classList.remove('active_bd');
        });
        currentIndex = index;
        var newSrc = listImg[index].getAttribute('src');
        console.log("New image source:", newSrc);
        imgFeature.src = newSrc;
        listImg[index].parentElement.classList.add('active_bd');
    }

    listImg.forEach((imgElement, index) => {
        imgElement.addEventListener('click', function() {
            console.log('Image clicked: ', index);
            updateImagebyIndex(index);
        });
    });
});

// ===========POPUP=============
const toastTrigger = document.getElementById('liveToastBtn')
const toastLiveExample = document.getElementById('liveToast')
if (toastTrigger) {
  toastTrigger.addEventListener('click', () => {
    const toast = new bootstrap.Toast(toastLiveExample)

    toast.show()
  })
}