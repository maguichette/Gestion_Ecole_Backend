<?php

// api/src/DataProvider/BlogPostCollectionDataProvider.php

namespace App\DataProvider;

use App\Entity\Promo;
use App\DataProvider\PromoProvider;
use App\Repository\PromoRepository;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use ApiPlatform\Core\Exception\ResourceClassNotSupportedException;
use ApiPlatform\Core\DataProvider\ContextAwareCollectionDataProviderInterface;

final class PromoProvider implements ContextAwareCollectionDataProviderInterface, RestrictedDataProviderInterface
{
    
    private $promo;
    public function __construct( PromoRepository $promo){
       
        
        $this->promo=$promo;  
    }
    public function supports(string $resourceClass, string $operationName = null, array $context = []): bool
    {
        
        if ($operationName ==="get_promo") {
           return false;
        }
        else{return Promo::class === $resourceClass;
        }
    }

    public function getCollection(string $resourceClass, string $operationName = null, array $context = []): iterable
    {
       
        if($operationName =="get_admin_promo_principal"){
             
         return   $this->promo->getRefPromoApp();
        }
        elseif ($operationName == "get_promo_apprenants_attente") {
            return $this->promo->getAppPromoattent();
            
        }
    }
}