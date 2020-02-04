<?php require "header.php"; 

require "action/dbconn.php";

if(isset($_SESSION["idUser"])){
    $userForm = 'readonly class="form-control-plaintext mb-1" value="' . $_SESSION["nameUser"] . '"';
    $emailForm = 'readonly class="form-control-plaintext mb-1" value="' . $_SESSION["emailUser"] . '"';

} else{
    $userForm = 'class="form-control mb-1" placeholder="Your name..."';
    $emailForm = 'class="form-control mb-1" placeholder="Your email..."';
}
?>


<section class="container">


    <div class="container my-5">
      <div class="row cover-border">
            <img class="glr-header" src="img/oulu2.jpg" onmouseover="this.src='img/oulu2-black.jpg'" onmouseout="this.src='img/oulu2.jpg'" alt="...">
      </div>
    </div>


<div class="container">
<div class="row mb-5">
    <div class="col-12 col-lg-6 contact-bg1">
        <form action="action/contact-form-exc.php" method="post" id="form-reg" class="container">
        <h3>Send E-mail</h3>
            <input name="user" type="text" <?php echo $userForm; ?>>
            <input name="email" type="text" <?php echo $emailForm; ?>>
            <input name="subject" type="text" class="form-control mb-3" placeholder="Subject...">
            <textarea name="message" type="text" class="form-control mb-3" placeholder="Write you message here..."></textarea>

            <button name="contact-submit" type="submit" class="btn btn-info mb-3">Send</button>
        </form>
        <?php 
                    if(isset($_GET["email"])){
                        if($_GET["email"] == "success"){
                            echo '<div class="alert alert-success mt-2" role="alert">
                                    E-mail sent successfully!
                                </div>';
                        }
                    } elseif(isset($_GET["error"])){
                        if($_GET["error"] == "emptyfields"){
                          echo '<div class="alert alert-danger" role="alert">
                                  All the fields (except Subject) are required!
                                </div>';
                        }
                    }
        ?>
    </div>
    <div class="col-12 col-lg-6 contact-bg2">
      <h1>OSAOn vaihde</h1>
      <h6>p. 010 608 2020<br>(8,4 snt/min, sis. alv 24 %)</h6><br>
      <h1>Laskutusosoite</h1>
      <h5>Operaattori: Basware Oy <br>
            Välittäjän tunnus: BAWCFI22 <br>
            Verkkolaskuosoite / OVT-tunnus: 003709924453</h5>
    </div>
</div>
<div class="row mb-5">
    <div class="col-12 col-lg-6 contact-bg2">
        <h1>OSAO, Kaukovainion yksikkö, palvelut</h1><br>
        <h5>Kotkantie 2 C, 90250 Oulu</h5>
        <h5>kaukovainio.palvelut@osao.fi</h5>
        <h5>yksikönjohtaja Antti Rovamo</h5>
        <a href="https://www.facebook.com/osaobook/" target="_blank" class="fa fa-facebook"></a>
        <a href="https://twitter.com/osaotweet" target="_blank" class="fa fa-twitter"></a>
        <a href="https://www.instagram.com/osaoinstagram/" target="_blank" class="fa fa-instagram"></a>
        <a href="https://www.youtube.com/channel/UCaq6f6DGoCAq4YWvNyP5azQ" target="_blank" class="fa fa-youtube"></a>
        <a href="https://www.snapchat.com/add/osaosnap" target="_blank" class="fa fa-snapchat-ghost"></a>
        <a href="https://www.linkedin.com/school/osao/" target="_blank" class="fa fa-linkedin"></a>

    </div>
    <div class="col-12 col-lg-6 contact-bg1">
        <iframe id="map" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1686.185119355083!2d25.512387116338296!3d64.99976175111064!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4681cd452484e151%3A0x966e34ee5a889f12!2sKotkantie%202%2C%2090250%20Oulu!5e0!3m2!1sfi!2sfi!4v1579888816328!5m2!1sfi!2sfi" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
    </div>
</div>
</div>



</section>

<?php require "footer.php"; ?>