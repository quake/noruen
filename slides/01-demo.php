<?php
include __DIR__.'/../../ASCIIPoint/lib/bootstrap.php';

$alpha = include __DIR__.'/../../ASCIIPoint/lib/letters.php';

$slide = new Slide(101, 31);
$slide->clear();

$heading = new Actor([23,-6], function($slide) use($alpha){
  $this->slideY(1,1);
  $slide->spriteWord($this->c, 'Demo', $alpha);
});
$slide->attachActor($heading);


$bio = new Actor([100,9], function($slide){
  static $targetText = null;
  static $displayText;

  if (is_null($targetText)){
    $targetText = str_split(
      "- HD Wallet\n".
      "- Send / Receive\n".
      "- Neuron Compatible\n"
    );
  }

  $this->slideX(60, 2);

  $displayText .= array_shift($targetText);
  $slide->text($this->c, $displayText, 25);
});

$sheepySprite = Sprite::fromImage(__DIR__."/tomnomnom.jpg", 20);

$sheepy = new Actor([1,30], function($slide) use($sheepySprite, $bio){

  if ($this->slideY(8, 2)){
    $slide->attachActor($bio);
  }

  $slide->sprite($this->c, $sheepySprite);
});
$slide->attachActor($sheepy);


$border = new Actor([0,0], function($slide){
  $slide->rect($this->c, [100,30], '#');
});
$slide->attachActor($border);

return $slide;
