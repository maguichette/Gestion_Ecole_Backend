<?php
namespace App\DataProvider;

use App\Entity\Promo;

use App\Repository\PromoRepository;
use App\DataProvider\PromoItemProvider;
use ApiPlatform\Core\DataProvider\ItemDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use ApiPlatform\Core\Exception\ResourceClassNotSupportedException;

final class PromoItemProvider implements ItemDataProviderInterface, RestrictedDataProviderInterface
{
    private $promo;
    public function __construct( PromoRepository $promo){
       
        
        $this->promo=$promo;  
    }
    public function supports(string $resourceClass, string $operationName = null, array $context = []): bool
    {
        
        if ($operationName==="formateurs_get_subresource" or $operationName==="get_promo_id") {
            return false;
        }
        else{return Promo::class === $resourceClass;
        }
    }

    public function getItem(string $resourceClass, $id, string $operationName = null, array $context = []) 
    {
        if($operationName =="get_promo_id_principal"){
            return   $this->promo->getonePromoPrincipal($id);
        }
    }
}