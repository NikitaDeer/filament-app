<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Page>
 */
class PageFactory extends Factory
{
  /**
   * Define the model's default state.
   *
   * @return array<string, mixed>
   */
  public function definition(): array
  {
    return [
      //заголовки
      'FirstTitle' => $this->faker->sentence(2),
      'SecondTitle' => $this->faker->sentence(3),
      'ThirdTitle' => $this->faker->sentence(4),
      'FourthTitle' => $this->faker->sentence(5),

      //контент
      'content' => $this->faker->paragraph($nb_sentences = 5, $variable_nb_sentences = False),
      'main_content' => $this->faker->paragraph($nb_sentences = 10, $variable_nb_sentences = False),
      'about_content' => $this->faker->paragraph($nb_sentences = 7, $variable_nb_sentences = False),
      'about_second_content' => $this->faker->paragraph($nb_sentences = 5, $variable_nb_sentences = False),
      'footer_content' => $this->faker->paragraph($nb_sentences = 7, $variable_nb_sentences = False),
      'footer_second_content' => $this->faker->paragraph($nb_sentences = 5, $variable_nb_sentences = False),

      //фотографии
      // 'main_photo_path' => $this->createImage(),
      // 'first_photo_path' => $this->createImage(),
      // 'second_photo_path' => $this->createImage(),
    ];
  }

  //генерация рандомных картинок для заполнения
  public function createImage()
  {
    // userAgent
    $context = stream_context_create(
      array(
        "http" => array(
          "header" => "User-Agent: Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.102 Safari/537.36"
        )
      )
    );

    // $photo_path = file_get_contents('https://picsum.photos/640/480', false, $context);
    // $photo_path = file_get_contents('https://loremflickr.com/640/480', false, $context);
    $filename = '/images/' . Str::uuid() . '.jpg';

    // Storage::disk('public')->put($filename, $photo_path);
    

    return $filename;
  }
}
