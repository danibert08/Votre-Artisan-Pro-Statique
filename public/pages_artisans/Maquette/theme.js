

const select = document.getElementById('theme-select');
const body = document.getElementById('body');

select.addEventListener('change', function(){
const color = this.value;
body.removeAttribute('class');
body.classList.add(color)
})

const photos = document.getElementsByClassName("photo");

    
    // for (let i=0;  i<photos.length; i++) {
        
    // const photo = photos[i];
    photos.addEventListener('click',imgZoom);
        


function imgZoom(e){
    const photosinfo = photos.getBoundingClientRect();
    const x = e.clientX - photosinfo.left;
    console.log(x);
}