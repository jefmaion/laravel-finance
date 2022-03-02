<?php

    namespace App\Interfaces;

    use Illuminate\Support\Collection;
    use Illuminate\Database\Eloquent\Model;

    interface RepositoryInterface {

        /**
         * Return all data in the repository
         *
         * @return Collection
         */
        public function all(): Collection;

        /**
         * Return an data by id field
         *
         * @param integer $id
         * @return Model|null
         */
        public function getById(int $id): ?Model;

        /**
         * Store a new register in storage
         *
         * @param array $request
         * @return Model
         */
        public function create(array $request): Model;

        /**
         * Store many register at time in storage
         *
         * @param array $attributes
         * @return boolean
         */
        public function createMany(array $attributes): bool;

        /**
         * Update an especific register
         *
         * @param array $request
         * @param integer $id
         * @return Model
         */
        public function update(array $request, int $id): Model;

        /**
         * Remove an register from storage
         *
         * @param integer $id
         * @return void
         */
        public function destroy(int $id): void;

    }
