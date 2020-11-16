<?php

namespace App\Policies;

use App\User;
use App\Professor;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProfessorPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the professor.
     *
     * @param  \App\User  $user
     * @param  \App\Professor  $professor
     * @return mixed
     */
    public function view(User $user, Professor $professor)
    {
        return $this->verificaProfessor($user, $professor);
    }

    /**
     * Determine whether the user can show the professor.
     *
     * @param  \App\User  $user
     * @param  \App\Professor  $professor
     * @return mixed
     */
    public function show(User $user, Professor $professor)
    {
        return $this->verificaProfessor($user, $professor);
    }

    /**
     * Determine whether the user can edit the aluno.
     *
     * @param  \App\User  $user
     * @param  \App\Professor  $professor
     * @return mixed
     */
    public function edit(User $user, Professor $professor)
    {
        return $this->verificaProfessor($user, $professor);
    }

    /**
     * Determine whether the user can create professors.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the professor.
     *
     * @param  \App\User  $user
     * @param  \App\Professor  $professor
     * @return mixed
     */
    public function update(User $user, Professor $professor)
    {
        //
    }

    /**
     * Determine whether the user can delete the professor.
     *
     * @param  \App\User  $user
     * @param  \App\Professor  $professor
     * @return mixed
     */
    public function delete(User $user, Professor $professor)
    {
        return $this->verificaProfessor($user, $professor);
    }

    /**
     * @param User $user
     * @param Professor $professor
     * @return bool
     */
    public function verificaProfessor(User $user, Professor $professor): bool
    {
        $escolas = [];
        foreach ($professor->escola as $escola) {
            $escolas[] = $escola->id;
        }
        if (in_array($user->escola->id, $escolas)) {
            return true;
        }else{
            return false;
        }
    }
}
