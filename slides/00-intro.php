<?php
// Bootstrap the ASCIIPoint library
include __DIR__.'/../../ASCIIPoint/lib/bootstrap.php';


// Create a new slide
$slide = new Slide(101, 31);

// Create a sprite from an image
$logoSprite = Sprite::fromImage(__DIR__."/nervos.jpg", 32);

// Create a new Actor, using the logo sprite created above
$logo = new Actor([9,30], function($slide) use($logoSprite){

  // Slide the sprite from [9,30] to [9,2], at 2 steps per frame
  $this->slideY(2, 2);

  // Draw the sprite at the current coordinates ($this->c) in bold blue.
  $slide->sprite($this->c, $logoSprite, Slide::BLUE_BOLD);
});

// Attach the actor to the slide so it's displayed
$slide->attachActor($logo);



// Include the "alphabet" of sprites for the "Point" part of the logo
$alpha = include __DIR__.'/../../ASCIIPoint/lib/letters.php';

$point = new Actor([54,-6], function($slide) use($alpha){
  $this->slideY(14,1);

  // Draw "Point" using the sprite alphabet included above in bold red
  $slide->spriteWord($this->c, 'Noruen', $alpha, Slide::RED_BOLD);
});
$slide->attachActor($point);



// Some information text in a "typewriter" fashion
$intro = new Actor([54,25], function($slide){
  // Static state is used to track which characters have been written
  static $targetText = null;
  static $displayText;

  // Only add the target text on the first call
  if (is_null($targetText)){
    $targetText = str_split(
      "A \"native\" CKB wallet in 999 lines of code\n".
      "By @quake\n"
    );
  }

  // Take the next character of the target text and draw in in green
  $displayText .= array_shift($targetText);
  $slide->text($this->c, $displayText, 50, Slide::GREEN);
});
$slide->attachActor($intro);



// Add a green border around the slide
$border = new Actor([0,0], function($slide){
  $slide->rect($this->c, [100,30], '*', Slide::GREEN);
});
$slide->attachActor($border);



// Remember to return the Slide object so the presenter script can use it.
return $slide;