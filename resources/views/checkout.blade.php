@php
$carts=session()->get('cart',[]);

$totalQty=0;
$subtotal=0;
$delivery=150;
$total=0;

$totalQty=array_sum(array_column($carts,'qty'));

// Calculate the total price with validation
$subtotal = array_sum(array_map(function($item) {
// Ensure the discount and quantity keys exist and are numeric
$price = isset($item['price']) ? $item['price'] : 0;
$discount = isset($item['discount']) ? $item['discount'] : 0;
$qty = isset($item['qty']) ? $item['qty'] : 0;

// Calculate the effective price after discount
$effectivePrice = $price - ($price * $discount / 100);

// Multiply by quantity and return
return $effectivePrice * $qty;
}, $carts));

$total=$subtotal+$delivery;


@endphp
<!doctype html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
  <style>
    /* Custom Radio Button Style */
    input[type="radio"] {
      appearance: none;
      -webkit-appearance: none;
      -moz-appearance: none;
      width: 1.25rem;
      height: 1.25rem;
      border: 2px solid #4A5568;
      /* Tailwind gray-700 */
      border-radius: 9999px;
      /* Full-rounded */
      outline: none;
      cursor: pointer;
      transition: background 0.3s ease, border-color 0.3s ease;
    }

    input[type="radio"]:checked {
      border-color: #3182CE;
      /* Tailwind blue-600 */
      background: radial-gradient(circle, #3182CE 50%, transparent 50%);
    }


    input[type="radio"]:focus {
      border-color: #63B3ED;
      /* Tailwind blue-400 */
      box-shadow: 0 0 0 3px rgba(99, 179, 237, 0.5);
      /* Tailwind blue-400 with opacity */
    }
  </style>
  @vite('resources/css/app.css')
</head>

<body class="bg-primary w-screen h-screen p-0 m-0 overflow-x-hidden">
  <header class="w-full bg-primary z-50">
    <img src="{{ asset('images/sia-logo.png') }}" alt="SIA" class="w-24 h-auto aspect-auto mx-auto ">
  </header>

  <main id="main1"
    class="w-full flex flex-col justify-start items-center m-0 p-0 md:border-t md:border-gray-400  md:px-5 md:gap-x-4 bg-primary md:flex-row-reverse md:items-start ">
    <section class="w-full md:w-[45%] md:px-10">
      <div class="bg-secondary w-full flex justify-between items-center p-4 z-20 md:bg-primary">
        <h1 class="text-base font-gray-800">order summary ({{ $totalQty }} items)</h1>
        <div id="showButton" class="flex justify-end items-center gap-x-1 cursor-pointer ">
          <span>Rs.{{ $subtotal }}</span>
          <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#000">
            <path d="M480-344 240-584l56-56 184 184 184-184 56 56-240 240Z" />
          </svg>
        </div>

      </div>
      <div class="relative w-full overflow-y-hidden ">
        <div id="show-summary"
          class="absolute top-0 left-0 -translate-y-full md:relative md:translate-y-0 md:bg-primary transform transition-all duration-300 ease-in-out w-full flex flex-col justify-center items-start gap-y-6 py-10 px-2 z-10 bg-white">
          @foreach ($carts as $cart => $item)
          @if(is_array($item))
          <div class="flex justify-evenly items-center w-full md:justify-between">
            <div class="flex justify-center items-center gap-x-4">
              <div class="relative w-20">
                <img src="{{ asset('images/'.$item['image']) }}"
                  class="w-full h-auto aspect-auto rounded-sm drop-shadow-xl" alt="">
                <span
                  class="absolute top-0 translate-x-3 -translate-y-3 right-0 size-8 flex justify-center items-center bg-gray-400 text-lg text-white rounded-full">{{
                  $item['qty'] }}</span>
              </div>
              <span class="uppercase font-normal text-base tracking-wider">{{ $item['name'] }}</span>
            </div>
            <span class="tracking-wider font-normal text-base">
              Rs. {{ $item['price']-($item['price']*$item['discount']/100) }}
            </span>
          </div>
          @endif
          @endforeach
          <div
            class="w-full flex flex-col justify-center items-start gap-y-4 border-y border-gray-300 py-4 text-gray-600">
            <div class="w-full flex justify-between items-start">
              <span>sub total</span>
              <span>Rs. {{ $subtotal }}</span>
            </div>
            <div class="w-full flex justify-between items-start">
              <span>delivery</span>
              <span>Rs. {{ $delivery }}</span>
            </div>
          </div>
          <div class="w-full justify-between flex items-center text-gray-700">
            <span class="font-medium text-lg uppercase">total</span>
            <span class="font-semibold text-3xl tracking-wide">Rs. {{ $total }}</span>
          </div>
        </div>
      </div>
    </section>

    <section class="full py-10 md:w-1/2  md:border-r md:border-gray-400 ">
      <h1 class="uppercase w-full text-center font-semibold text-4xl text-gray-900">Billing Details</h1>
      <form action="" method="" class="w-full flex justify-center items-center gap-y-3 flex-col p-4 ">
        <div class="w-full ">
          <x-forms.label for="email" content="Email" />
          <x-forms.input name="email" type="email" autofocus />
        </div>
        <div class="w-full flex justify-between items-center md:flex-row flex-col gap-3">
          <div class="w-full">
            <x-forms.label for="fname" content="First Name" />
            <x-forms.input name="fname" type="text" />
          </div>
          <div class="w-full">
            <x-forms.label for="lname" content="Last Name" />
            <x-forms.input name="lname" type="text" />
          </div>
        </div>
        <div class="w-full flex justify-between items-center md:flex-row flex-col gap-4 py-2">
          <div class="w-full flex justify-start items-center gap-3 ">
            <x-forms.label for="state" content="state" />
            <select name="state" class="w-full  text-center h-10 text-lg capitalize bg-primary">
              <option value="1">state 1</option>
              <option value="1">state 1</option>
              <option value="1">state 1</option>
            </select>
          </div>
          <div class="w-full flex justify-start items-center gap-x-2">
            <x-forms.label for="district" content="district" />
            <select name="district" class="w-full  text-center h-10 text-lg capitalize bg-primary">
              <option value="1">district 1</option>
              <option value="1">district 1</option>
              <option value="1">district 1</option>
            </select>
          </div>
        </div>
        <div class="w-full flex justify-between items-center flex-wrap">
          <x-forms.label for="address" content="address" />
          <x-forms.input name="address" type="text" />
        </div>
        <div class=" flex flex-col w-full items-center justify-center gap-y-1">
          <h2 class="w-full capitalize text-lg">select payment method</h2>
          <div class="flex flex-col w-full items-center justify-center gap-y-5">
            <div
              class="w-full border-2 border-gray-300 p-2 flex items-center space-x-2 cursor-pointer transition duration-300 hover:border-blue-600 focus-within:border-blue-600">
              <label class="w-full inline-flex items-center">
                <input type="radio" name="payment" class="custom-radio" value="pay" checked />
                <span class="ml-2 text-gray-700 capitalize">Pay now</span>
              </label>
            </div>
            <div
              class="w-full border-2 border-gray-300 p-2 flex items-center space-x-2 cursor-pointer transition duration-300 hover:border-blue-600 focus-within:border-blue-600">

              <label class="w-full inline-flex items-center">
                <input type="radio" name="payment" class="custom-radio" value="cod" />
                <span class="ml-2 text-gray-700 capitalize">cash on delivery</span>
              </label>
            </div>
          </div>

        </div>
        <x-forms.button content="confirm order" type="submit" class="w-full" />
      </form>
    </section>
  </main>
  <script>
    const show=document.getElementById('show-summary');
    const showButton=document.getElementById('showButton');

    showButton.addEventListener('click',function(){
      console.log("object");
      show.classList.toggle('absolute');
      show.classList.toggle('top-o');
      show.classList.toggle('left-0');
      show.classList.toggle('-translate-y-full');
    });
    
  </script>
</body>

</html>