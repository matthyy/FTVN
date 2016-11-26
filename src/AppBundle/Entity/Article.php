<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity(repositoryClass="")
 * @ORM\Table(name="article")
 * @ORM\HasLifecycleCallbacks()
 */
class Article
{
    /**
     * @ORM\Id()
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(name="title", type="string", length=255)
     */
     private $title;

    /**
    * @ORM\Column(name="created_by", type="string", length=255)
    */
    private $createdBy;

    /**
    * @ORM\Column(name="leadingg", type="text", nullable=true)
    */
    private $leadingg;

    /**
    * @ORM\Column(name="body", type="text", nullable=true)
    */
    private $body;

    /**
    * @ORM\Column(name="created_at", type="datetime")
    */
    private $createdAt;

    /**
    * @ORM\Column(name="slug", type="string", length=255)
    * @GeDMO\Slug(fields={"title"})
    */
    private $slug;  

    /**
    * @ORM\PrePersist
    */
    public function persistDate(){
        $this->setCreatedAt(new \Datetime("now"));
    }

     /**
     * Get title
     * @return  
     */
     public function getTitle()
     {
         return $this->title;
     }
     
     /**
     * Set title
     * @return $this
     */
     public function setTitle($title)
     {
         $this->title = $title;
         return $this;
     }

     /**
     * Get id
     * @return  
     */
     public function getId()
     {
         return $this->id;
     }
     
     /**
     * Set id
     * @return $this
     */
     public function setId($id)
     {
         $this->id = $id;
         return $this;
     }

     /**
     * Get leading
     * @return  
     */
     public function getLeadingg()
     {
         return $this->leadingg;
     }
     
     /**
     * Set leading
     * @return $this
     */
     public function setLeadingg($leadingg)
     {
         $this->leadingg = $leadingg;
         return $this;
     }

     /**
     * Get body
     * @return  
     */
     public function getBody()
     {
         return $this->body;
     }
     
     /**
     * Set body
     * @return $this
     */
     public function setBody($body)
     {
         $this->body = $body;
         return $this;
     }

     /**
     * Get createdBy
     * @return  
     */
     public function getCreatedBy()
     {
         return $this->createdBy;
     }
     
     /**
     * Set createdBy
     * @return $this
     */
     public function setCreatedBy($createdBy)
     {
         $this->createdBy = $createdBy;
         return $this;
     }

     /**
     * Get slug
     * @return  
     */
     public function getSlug()
     {
         return $this->slug;
     }
     
     /**
     * Set slug
     * @return $this
     */
     public function setSlug($slug)
     {
         $this->slug = $slug;
         return $this;
     }

     /**
     * Get createdAt
     * @return  
     */
     public function getCreatedAt()
     {
         return $this->createdAt;
     }
     
     /**
     * Set createdAt
     * @return $this
     */
     public function setCreatedAt($createdAt)
     {
         $this->createdAt = $createdAt;
         return $this;
     }
}