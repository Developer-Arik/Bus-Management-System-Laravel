<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InformationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [[
            "title" => "about",
            "description" => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Minima delectus, fuga impedit culpa aut qui nisi. Inventore cupiditate soluta distinctio molestias! Totam harum, laboriosam necessitatibus ex unde, dicta mollitia ullam dolor temporibus maiores dolorum dolorem eaque impedit nobis earum in omnis doloribus! Totam nihil qui consectetur quam? Labore provident quidem doloremque illum, eveniet repudiandae ut nihil ipsa est reprehenderit voluptatem autem ipsum pariatur totam quisquam nisi debitis perferendis repellendus! Quisquam et earum natus voluptatum aspernatur quae, cumque vel quidem. Esse deleniti corporis architecto tempore accusantium vero nisi dolor, quasi repellendus repudiandae consequatur eos obcaecati quod sapiente ratione molestias quas qui neque rem, placeat quam! Illum, at exercitationem, deserunt ratione porro officia vitae iste eligendi expedita non doloremque laborum minima optio."
        ],[
            "title" => "xxx",
            "description" => "Lor"
        ]];
        for ($i=0; $i < sizeof($data); $i++) {
            $inf = $data[$i];
            DB::table('informations')->insert([
                "title" => $inf['title'],
                "description" => $inf['description']
            ]);
        }
    }
}
