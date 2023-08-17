<?php

    namespace App\Repositories;


    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Query\Builder;
    use Illuminate\Support\Facades\DB;

    abstract class Repository
    {


        public function table(string $table): Builder
        {
            return DB::table($table);
        }


        public function query($sql): array
        {
            return DB::select($sql);
        }

        public function query_one($sql): object|null
        {
            return DB::selectOne($sql);
        }


    }
