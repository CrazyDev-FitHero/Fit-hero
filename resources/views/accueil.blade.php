@extends('layouts.base')

@section('title', 'Accueil')

@section('content')



    <?php
    $tab=[];
    $tabGif = [];
    foreach($randomSerie as $serie) {
        for ($i = 0; $i < $serie->repetitions; $i++)
        {
            $tab[] = $serie->exos->codeexercice;

//            $tabGif[] = base64_encode($serie->exos->getGifExerciceBase64());
        }
    }

    ?>


{{--    @foreach($tabGif as $gif)--}}
{{--        <img src="data:image/gif;base64,{{ $gif->getGifExerciceBase64() }}" alt="Exercice GIF">--}}
{{--    @endforeach--}}

    <script>
        const expectedSeries = @json($tab);
        {{--const gifExercices = @json($tabGif);--}}
    </script>


    <div class="flex h-screen bg-main">
    <!-- Sidebar -->
    <div class="w-15 bg-radient flex flex-col justify-between items-center py-5">
        <div class="flex flex-col items-center gap-10">
            <a href="{{ url('/accueil') }}" class="custom-logo">
                <img src="../build/assets/img/logo-fithero.png" alt="logo fithero">
            </a>
            <a href="<?php //leaderboard ?>" class="leaderboard__link">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path d="M400 0L176 0c-26.5 0-48.1 21.8-47.1 48.2c.2 5.3 .4 10.6 .7 15.8L24 64C10.7 64 0 74.7 0 88c0 92.6 33.5 157 78.5 200.7c44.3 43.1 98.3 64.8 138.1 75.8c23.4 6.5 39.4 26 39.4 45.6c0 20.9-17 37.9-37.9 37.9L192 448c-17.7 0-32 14.3-32 32s14.3 32 32 32l192 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-26.1 0C337 448 320 431 320 410.1c0-19.6 15.9-39.2 39.4-45.6c39.9-11 93.9-32.7 138.2-75.8C542.5 245 576 180.6 576 88c0-13.3-10.7-24-24-24L446.4 64c.3-5.2 .5-10.4 .7-15.8C448.1 21.8 426.5 0 400 0zM48.9 112l84.4 0c9.1 90.1 29.2 150.3 51.9 190.6c-24.9-11-50.8-26.5-73.2-48.3c-32-31.1-58-76-63-142.3zM464.1 254.3c-22.4 21.8-48.3 37.3-73.2 48.3c22.7-40.3 42.8-100.5 51.9-190.6l84.4 0c-5.1 66.3-31.1 111.2-63 142.3z"/></svg>
            </a>
            <a href="<?php //profil ?>" class="profil__link">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512l388.6 0c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304l-91.4 0z"/></svg>
            </a>
        </div>
        <div class="mb-5">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <a href="{{ route('logout') }}" class="log-out flex flex-col items-center gap-5" onclick="event.preventDefault(); this.closest('form').submit();">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M377.9 105.9L500.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L377.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1-128 0c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM160 96L96 96c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c-53 0-96-43-96-96L0 128C0 75 43 32 96 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32z"/></svg>
                    <p class="text-white text-xs">SE DÉCONNECTER</p>
                </a>
            </form>
        </div>
    </div>


    <!-- Main Content -->
    <div class="flex-1 flex justify-center items-center p-5 mt-2 flex-col gap-10">
        <h1 class="h1-title">Faites progresser votre hero en réalisant des exercices !</h1>
        <div class="set-items flex flex-row gap-2">
            <div class="serie-title--wrapper flex flex-row items-center gap-5">
                <h2 class="set-title">Série</h2>
            </div>
            <div class="set-schemas flex flex-row ">
                @foreach($randomSerie as $serie)
                    @for($i = 0; $i < $serie->repetitions; $i++)
                        <div class="flex flex-col items-center gap-5">
                                <?php
                                $imageData = base64_encode($serie->exos->imageexercice);
                                $imageType = 'image/png';
                                $imageSrc = "data:".$imageType.";base64,".$imageData;
                                ?>
                            <img src="{{ $imageSrc }}" alt="Exercice №{{$i}}" class="w-10">
                        </div>
                    @endfor
                @endforeach
            </div>

        </div>
        <div class="schema--wrapper rounded-2xl p-5 shadow-lg w-[600px] h-[300px] flex">
            <!-- Left Panel -->
            <div class="flex flex-col items-center text-white w-1/2 relative">
                <canvas id="patternCanvas" width="300" height="300"
                    class="absolute top-0 left-0 z-100 pointer-events-none"></canvas>
                <div class="schema grid grid-cols-3 gap-10 relative">
                    <div data-index="0" class="w-12 h-12 bg-gray-300 rounded-full flex justify-center items-center">
                    </div>
                    <div data-index="1" class="w-12 h-12 bg-gray-300 rounded-full flex justify-center items-center">
                    </div>
                    <div data-index="2" class="w-12 h-12 bg-gray-300 rounded-full flex justify-center items-center">
                    </div>
                    <div data-index="3" class="w-12 h-12 bg-gray-300 rounded-full flex justify-center items-center">
                    </div>
                    <div data-index="4" class="w-12 h-12 bg-gray-300 rounded-full flex justify-center items-center">
                    </div>
                    <div data-index="5" class="w-12 h-12 bg-gray-300 rounded-full flex justify-center items-center">
                    </div>
                    <div data-index="6" class="w-12 h-12 bg-gray-300 rounded-full flex justify-center items-center">
                    </div>
                    <div data-index="7" class="w-12 h-12 bg-gray-300 rounded-full flex justify-center items-center">
                    </div>
                    <div data-index="8" class="w-12 h-12 bg-gray-300 rounded-full flex justify-center items-center">
                    </div>
                </div>
                <div class="flex gap-4 mt-4">
                    <div class="plus-moins" id="plus-moins-id"></div>
                    <div class="strenght-indicator">Force : <span class="strenght-number">{{ $puissance }}</span></div>
                </div>
            </div>

            <!-- Right Panel -->
            <div class="exercice-image image">
{{--            <img src="data:image/gif;base64,{{ $tabGif[0]}}" alt="Exercice GIF1">--}}
            </div>
        </div>
        <div class="perso-image image">
            <img src="../build/assets/img/perso-1.png" alt="">
        </div>
    </div>
</div>


@endsection
