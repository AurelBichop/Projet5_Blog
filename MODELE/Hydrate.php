<?php
/**
 * trait Hydrate
 * pour l'hydratation d'objets avec un tableau associatif
 */

trait Hydrate
{
    protected function hydrate(array $data = null)
    {

        foreach ($data as $key=>$datemp) {

            //Function For the Camel Case
            if (strstr($key, '_')) {

                $motsepar = explode('_', $key);

                $motsepar[1] = ucfirst($motsepar[1]);
                $key = implode($motsepar);
            }

            $method = 'set'.ucfirst($key);

            if (method_exists($this, $method))
            {
                $this->$method($datemp);
            }
        }

    }

}