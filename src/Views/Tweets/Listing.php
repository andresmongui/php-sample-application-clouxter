<?php

namespace Views\Tweets;

use Entity\User;

class Listing
{
    protected $user;
    protected $tweets;
    protected $tweetsCount;

    public function __construct(User $user, array $tweets, int $tweetsCount)
    {
        $this->user = $user;
        $this->tweets = $tweets;
        $this->tweetsCount = $tweetsCount;
    }

    public function __invoke(): void
    {
        $userId = htmlspecialchars($this->user->id);
        $userName = htmlspecialchars($this->user->name);
?>
        <div class="col-xs-6 col-sm-5 col-md-4 col-lg-3">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="row">
                        <a class="col-xs-3" href="/<?php $userId ?>" title="<?php $userName ?>" tabindex="-1" aria-hidden="true" rel="noopener">
                            <img alt="@<?php $userId ?> avatar" class="img-rounded" src="/img/<?php $userId ?>">
                        </a>

                        <div class="col-xs-9">
                            <div>
                                <a href="/<?php $userId ?>" rel="noopener"><strong class="fullname"><?php $userName ?></strong></a>
                            </div>
                            <span dir="ltr">
                                <a href="/<?php $userId ?>" rel="noopener">@<span><?php $userId ?></span></a>
                            </span>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-3">
                            <h5>
                                <small>TWEETS</small>
                                <a href="#"><?php $this->tweetsCount ?></a>
                            </h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-6 col-sm-7 col-md-8 col-lg-9">
            <div class="panel panel-info">
                <div class="panel-body">
                <?php
                if (empty($this->tweets)) {
                    echo "<p>$userName has not tweeted yet!</p>";
                } else {
                    /** @var \Entity\Tweet $tweet */
                    foreach ($this->tweets as $tweet) {
                        ?>
                        <div class="media">
                            <a class="media-left" href="/<?php $userId ?>">
                                <img alt="@<?php $userId ?> avatar" class="img-rounded" src="/img/<?= $userId ?>">
                            </a>
                            <div class="media-body">
                                <a href="/<?php $userId ?>"><strong class="fullname"><?php $userName ?></strong></a>
                                <a href="/<?php $userId ?>">@<?php $userId ?></a> <small class="time"><a href="/<?php "$userId/status/" . htmlspecialchars($tweet->id) ?>"><?php $tweet->ts ?></a></small>
                                <p><?php htmlspecialchars($tweet->message) ?></p>
                            </div>
                        </div>
                </div>
            </div>
        </div>
