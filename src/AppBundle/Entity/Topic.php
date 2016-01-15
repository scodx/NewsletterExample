<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * Topic
 *
 * @ORM\Table(name="topic")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TopicRepository")
 */
class Topic
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @Assert\Length(max=45)
     * @ORM\Column(name="name", type="string", length=45)
     */
    private $name;


    /**
     * @ORM\OneToMany(targetEntity="Newsletter", mappedBy="topic")
     */
    protected $newsletters;


    /**
     * @ORM\OneToMany(targetEntity="Subscription", mappedBy="topic")
     */
    protected $subscriptions;


    public function __construct()
    {
        $this->newsletters = new ArrayCollection();
        $this->subscriptions = new ArrayCollection();
    }



    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Topic
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }






    /**
     * Add newsletter
     *
     * @param \AppBundle\Entity\Newsletter $newsletter
     *
     * @return Topic
     */
    public function addNewsletter(\AppBundle\Entity\Newsletter $newsletter)
    {
        $this->newsletters[] = $newsletter;

        return $this;
    }

    /**
     * Remove newsletter
     *
     * @param \AppBundle\Entity\Newsletter $newsletter
     */
    public function removeNewsletter(\AppBundle\Entity\Newsletter $newsletter)
    {
        $this->newsletters->removeElement($newsletter);
    }

    /**
     * Get newsletters
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getNewsletters()
    {
        return $this->newsletters;
    }

    /**
     * Add subscription
     *
     * @param \AppBundle\Entity\Subscription $subscription
     *
     * @return Topic
     */
    public function addSubscription(\AppBundle\Entity\Subscription $subscription)
    {
        $this->subscriptions[] = $subscription;

        return $this;
    }

    /**
     * Remove subscription
     *
     * @param \AppBundle\Entity\Subscription $subscription
     */
    public function removeSubscription(\AppBundle\Entity\Subscription $subscription)
    {
        $this->subscriptions->removeElement($subscription);
    }

    /**
     * Get subscriptions
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSubscriptions()
    {
        return $this->subscriptions;
    }
}
