<!DOCTYPE html>
<html lang="en">

<head>
    <x-client.head />
</head>

<body class="index-page">
    <header id="header" class="header fixed-top">
        <x-client.header />
        <x-client.navbar />
        </div>
    </header>

    <main class="main">

        <section id="home-about" class="home-about section">
            @yield('content')
        </section><!-- /Call To Action Section -->

    </main>
    <x-client.footer />

    <!-- Scroll Top -->
    <a href="#!" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Preloader -->
    <div id="preloader"></div>

    <x-client.script />

</body>

</html>
