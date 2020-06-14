 <!DOCTYPE html> <html> <head> <?php include("data/dbConnect.php"); include("libraries/WrapMySQL.php"); include("libraries/Parsedown.php"); ?> ; <link href="/styles/fontawesome.min.css" rel="stylesheet" /> <link href="/styles/style.min.css" rel="stylesheet" /> <link href="/styles/staggeredFade.min.css" rel="stylesheet" /> <link href="/styles/textElements.min.css" rel="stylesheet" /> <link href="/styles/formElements.min.css" rel="stylesheet" /> <link href="/styles/layoutGeneral.min.css" rel="stylesheet" /> ; <script src="/scripts/PageLayout.js"></script> <script src="/scripts/CommonScripts.js"></script> ; <meta name="viewport" content="width=device-width" /> ; <title>[T] Text Elements | Endev</title> </head> <body> <header> <a href="/"> <div class="endevLogo" id="endevLogo"></div> <div class="endevLogoSticky" id="endevLogoSticky"></div> </a> <nav class="default"> <div class="fullWidthMenu"> <a href="/">Home</a> <a href="/projects">Projects</a> <a href="/support">Support</a> <a href="/downloads">Downloads</a> <a href="/contact">Contact</a> <a href="/more">More</a> </div> <div class="mobileMenu stagFade"> <label for="toggleMobileMenuOverlay"><span>[T] Text Elements</span><a><i class="fa fa-bars"></i></a></label> <input type="checkbox" id="toggleMobileMenuOverlay" onchange="ShowElementIfChecked(this, 'mobileMenuOverlay')"/> <div class="mobileMenuOverlay" id="mobileMenuOverlay"> <a href="/">Home</a> <a href="/projects">Projects</a> <a href="/support">Support</a> <a href="/downloads">Downloads</a> <a href="/contact">Contact</a> <a href="/more">More</a> <label for="toggleMobileMenuOverlay"><a>Close</a></label> </div> </div> </nav> <nav class="default" style="display: none;"></nav> <div class="breakpointCheck"></div> </header> <main> <hr /> <hr /> <x-error>Error-Banner x-error</x-error> <x-warning>Warning-Banner x-warning</x-warning> <x-question>Question-Banner x-question</x-question> <x-info>Info-Banner x-info</x-info> <x-success>Success-Banner x-success</x-success> <hr /> <hr /> <h1>Heading 1</h1> <h2>Heading 2</h2> <h3>Heading 3</h3> <h4>Heading 4</h4> <h5>Heading 5</h5> <h6>Heading 6</h6> <hr /> <hr /> <x-md> <h1>MD Heading 1</h1> <h2>MD Heading 2</h2> <h3>MD Heading 3</h3> <h4>MD Heading 4</h4> <h5>MD Heading 5</h5> <h6>MD Heading 6</h6> </x-md> <hr /> <hr /> <x-md> <a href="#/"><h1>MD Heading 1</h1></a> <a href="#/"><h2>MD Heading 2</h2></a> <a href="#/"><h3>MD Heading 3</h3></a> <a href="#/"><h4>MD Heading 4</h4></a> <a href="#/"><h5>MD Heading 5</h5></a> <a href="#/"><h6>MD Heading 6</h6></a> </x-md> </main> <a href="#top"><div class="navigateToTop"><i class="fas fa-chevron-up"></i></div></a> <footer> </footer> </body> </html> 