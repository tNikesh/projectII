
document.addEventListener('DOMContentLoaded', function () {

  
    // hiding-shop-alert
    shopAlert=document.getElementById('shop-alert');
    header=document.getElementById('header');
    main1=document.getElementById('main1');
    hideShopAlert=document.getElementById('hide-shop-alert');
    hideShopAlert.addEventListener('click', function () {
        hidingShopAlert();
    });
    window.addEventListener('scroll',function(){
        var scrollPosition=window.screenY;
        if(this.scrollY>80){
            hidingShopAlert();
        }
        
    })
    function hidingShopAlert(){
        if(!shopAlert.classList.contains('hidden')){
            shopAlert.classList.add('hidden');
        }
        header.classList.remove('relative');
        header.classList.add('sticky');
        header.classList.add('top-0');
        // header.classList.add('left-0');
        // header.classList.add('left-0');
        // header.classList.add('left-0');
        // main1.classList.add('transform');
        // main1.classList.add('translate-y-96');
        // main.classList.add('md:pt-[900px]');
    }

});