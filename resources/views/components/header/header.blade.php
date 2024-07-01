@props(['class'=>''])
<Header id="header" {{ $attributes->merge(["class"=>"px-3 flex flex-col justify-start gap-2 items-center md:px-6 border-b border-gray-200 w-full h-32 md:h-52 bg-primary z-50  $class"]) }}>
    <!-- Nothing worth having comes easy. - Theodore Roosevelt -->
    <x-header.utilities class="z-30"/>
    <x-header.navbar class="z-30 "/>
    <x-header.search-field class="z-40"/>
    <x-header.cart class="z-40"/>

</Header>


@push('scripts')
<script>
    
document.addEventListener('DOMContentLoaded', function () {
// for displaying and hiding the seacrh field
const search2 = document.getElementById('show-search-2');
const search1 = document.getElementById('show-search-1');
const searchField = document.getElementById('search-field');
const hideSearch = document.getElementById('hide-search');

search2.addEventListener('click',showSearch);
search1.addEventListener('click',showSearch);

 function showSearch() {
        // display search field
        searchField.classList.remove('-translate-y-full');     
    }
hideSearch.addEventListener('click', function () {
    console.log("clicked");
    // hide seeach field
    searchField.classList.add('-translate-y-full');

});

//  hiding and display cart module
const menu = document.getElementById('menu-bar');
const nav = document.getElementById('nav-bar');
const hideNav = document.getElementById('hide-nav');
menu.addEventListener('click',function(){
    nav.classList.remove('-translate-x-full');
    menu.classList.add('-translate-x-[200px]');
    hideNav.classList.remove('-translate-x-[200px]');
});
hideNav.addEventListener('click',function(){
    nav.classList.add('-translate-x-full');
    hideNav.classList.add('-translate-x-[200px]');
    menu.classList.remove('-translate-x-[200px]');
});



//  hiding and display cart module
const cart = document.getElementById('cart');
const cartButton = document.getElementById('cart-button');
const hideCart=document.getElementById('hide-cart');
const body=document.body;
cartButton.addEventListener('click',function(){
    cart.classList.remove('translate-x-full');
    body.classList.add('overflow-hidden');
})
hideCart.addEventListener('click',function(){
    cart.classList.add('translate-x-full');
    body.classList.remove('overflow-hidden');
})

});
</script>
@endpush