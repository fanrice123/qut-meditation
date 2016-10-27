<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\imagine\Image;
use Imagine\Image\Box;

$this->title = 'About Us ~ Omm Meditation Centre';

//$image = Image::getImagine()->open('images/homepage.jpg');
//$image->thumbnail(new Box(1200, 800))->save('images/homePage.jpg', ['quelity' => 90]);
?>
<div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">
        <div class="item active">
            <?= Html::img('images/homepage.jpg', ['alt' =>"Ohm"]) ?>
            <div class="carousel-caption">
                <h3>Meditation</h3>
                <p>The atmosphere in our centre is lorem ipsum.</p>
            </div>
        </div>

        <div class="item">
            <?= Html::img('images/med2.jpg', ['alt' =>"Ohm"]) ?>
            <div class="carousel-caption">
                <h3>Community</h3>
                <p>Thank you, a night we won't forget.</p>
            </div>
        </div>

        <div class="item">
            <?= Html::img('images/med1.jpg', ['alt' =>"Ohm"]) ?>
            <div class="carousel-caption">
                <h3>Life</h3>
                <p>Even though the life was a mess, we had the best time.</p>
            </div>
        </div>
    </div>

    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>

<div class="container text-center" id="body" style="padding: 80px 120px">
    <h2><?= Html::encode($this->title) ?></h2>
    <p><em>Peace.</em></p>
    <p>We have created a place to let you RIP..</p>

    <p>
        Welcome to the Omm Meditation Centre website.
        We are a non-profit organisation that perform meditation courses on donation basis to
        people in Queensland and have offered our services to people all over the world since 1990s.
        Our course offers experience in basic rest and relaxation through to a variety of spiritual enlightening exercises.
        &nbsp;
    </p>

    <p>
        Our volunteer staff lend their warm and positive characters to our facility and lend over 25 years of knowledge and experience.
        We are always looking for more people willing to lend help to our facility and welcome kind-hearted people willing to add to the culture of our organisation.
        If you would like to volunteer as a server in our courses, you need to have signed up to our web page and have completed at least the 10 day course to get to know the existing staff and facility.
        &nbsp;
    </p>

    <p>
        Our Meditation Centre offers a limited number of courses ranging from 3 to 10 to 30 day courses dedicated to teaching you the exercises
        and activities to bring out the meditative states in you.
        &nbsp;
        With that being said, we welcome newcomers aboard and hope to see you around the facility soon!
        &nbsp;
        (Insert picture gallery of the centre here)
    </p>
</div>
<div class="site-index" >





</div>









<!--<?php

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index" id="body">

    <div class="jumbotron">
        <h1>Congratulations!</h1>

        <p class="lead">You have successfully created your Yii-powered application.</p>

        <p><a class="btn btn-lg btn-success" href="http://www.yiiframework.com">Get started with Yii</a></p>
    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-4">
                <h2>Heading</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-default" href="http://www.yiiframework.com/doc/">Yii Documentation &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Heading</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-default" href="http://www.yiiframework.com/forum/">Yii Forum &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Heading</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-default" href="http://www.yiiframework.com/extensions/">Yii Extensions &raquo;</a></p>
            </div>
        </div>
    </div>
</div>-->
