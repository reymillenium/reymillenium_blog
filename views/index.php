<html>
    <head>
        <title>Accordion test</title>
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
        <script type="text/javascript">


            $(document).ready(function () {
                $('a').click(function () {
                    //store the id of the collapsible element
                    localStorage.setItem('Accordion', $(this).attr('href'));
                });

                var collapseItem = localStorage.getItem('collapseItem');
                if (collapseItem) {
                    $(collapseItem).collapse('show')
                }
            });
        </script>
    <body>
        <ul id="Accordion">
            <li>
                PEOPLE
                <ul>
                    <li><strong>+</strong> <a href="index.php?show=philip&tiffany">PHILIP & TIFFANY</a></li>
                    <li><strong>+</strong> <a href="index.php?show=heindo">HEINDO</a></li>            
                    <li><strong>+</strong> <a href="index.php?show=juan">JUAN</a></li>
                    <li><strong>+</strong> <a href="index.php?show=bettina">BETTINA</a></li>
                    <li><strong>+</strong> <a href="index.php?show=adam">ADAM</a></li>
                    <li><strong>+</strong> <a href="index.php?show=hazel">HAZEL</a></li>
                    <li><strong>+</strong> <a href="index.php?show=ashton">ASHTON</a></li>
                    <li><strong>+</strong> <a href="index.php?show=martina">MARTINA</a></li>
                    <li><strong>+</strong> <a href="index.php?show=ava">AVA</a></li>
                    <li><strong>+</strong> <a href="index.php?show=michelle">MICHELLE</a></li>
                    <li><strong>+</strong> <a href="index.php?show=red">RED</a></li>
                    <li><strong>+</strong> <a href="index.php?show=erin">ERIN</a></li>
                    <li><strong>+</strong> <a href="index.php?show=scotty">SCOTTY</a></li>
                </ul>
            </li>
            <li>
                EVENTS
                <ul>
                    <li><strong>+</strong> <a href="#">COMING SOON</a></li>
                </ul>
            </li>
            <li>
                LANDSCAPES
                <ul>
                    <li><strong>+</strong> <a href="#">COMING SOON</a></li>
                </ul>
            </li>
            <li>
                INFO
                <ul>
                    <li><strong>+</strong> <a href="#">COMING SOON</a></li>
                </ul>
            </li>
        </ul>





        <div class="accordion" id="accordion2">
            <div class="accordion-group">
                <div class="accordion-heading">
                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseOne">
                        Collapsible Group Item #1
                    </a>
                </div>
                <div id="collapseOne" class="accordion-body collapse in">
                    <div class="accordion-inner">
                        Link : <a href="http://google.com">google.com</a>
                    </div>
                </div>
            </div>
            <div class="accordion-group">
                <div class="accordion-heading">
                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseTwo">
                        Collapsible Group Item #2
                    </a>
                </div>
                <div id="collapseTwo" class="accordion-body collapse">
                    <div class="accordion-inner">
                        Link : <a href="http://stackoverflow.com">stackoverflow.com</a>
                    </div>
                </div>
            </div>
            <div class="accordion-group">
                <div class="accordion-heading">
                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseThree">
                        Collapsible Group Item #3
                    </a>
                </div>
                <div id="collapseThree" class="accordion-body collapse">
                    <div class="accordion-inner">
                        Link : <a href="http://cryptozoologynews.blogspot.com/">cryptozoology news</a>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>