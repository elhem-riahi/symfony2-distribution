<?php
namespace Application\UserBundle\Entity;

use FOS\UserBundle\Entity\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use FOS\MessageBundle\Model\ParticipantInterface;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\UploadedFile;

use Application\SiteBundle\Entity\Brick;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 * @Vich\Uploadable
 */
class User extends BaseUser implements ParticipantInterface
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(name="github_id", type="string", length=255, nullable=true)
     * @var string
     */
    protected $githubId;

    /**
     * @ORM\Column(name="github_access_token", type="string", length=255, nullable=true)
     * @var string
     */
    protected $githubAccessToken;

    /**
     * @ORM\Column(name="twitter_id", type="string", length=255, nullable=true)
     * @var string
     */
    protected $twitterId;

    /**
     * @ORM\Column(name="twitter_access_token", type="string", length=255, nullable=true)
     * @var string
     */
    protected $twitterAccessToken;

    /**
     * @ORM\Column(name="sensiolabsconnect_id", type="string", length=255, nullable=true)
     * @var string
     */
    protected $sensiolabsconnectId;

    /**
     * @ORM\Column(name="sensiolabsconnect_access_token", type="string", length=255, nullable=true)
     * @var string
     */
    protected $sensiolabsconnectAccessToken;

    /**
     * @var boolean $emailpolicy_send_on_new_message
     *
     * @ORM\Column(type="boolean", nullable=true)
     */
    protected $emailpolicy_send_on_new_message = true;

    /**
     * @Assert\File(
     *     maxSize="1M",
     *     mimeTypes={"image/png", "image/jpeg", "image/pjpeg", "image/gif"}
     * )
     * @Vich\UploadableField(mapping="user_profile_image", fileNameProperty="profileImageName")
     *
     * @var File $profileImage
     */
    public $profileImage;

    /**
     * @ORM\Column(type="string", length=255, name="profile_image_name", nullable=true)
     *
     * @var string $profileImageName
     */
    protected $profileImageName;

    /**
     * @var datetime $created_at
     *
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime")
     */
    protected $created_at;

    /**
     * @var datetime $updated_at
     *
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(type="datetime")
     */
    protected $updated_at;


    /**************************************************************************************************
     *	custom functions
     **************************************************************************************************/
    public function __construct()
    {
        parent::__construct();
        // your own logic
    }

    /**
     * VichUploaderBundle Fix
     * Dirty, but https://github.com/dustin10/VichUploaderBundle/issues/8 is still an open problem
     */
    public function setProfileImage($file)
    {
        $this->profileImage = $file;

        if ($file instanceof UploadedFile) {
            $this->setUpdatedAt(new \DateTime());
        }
    }

    /**************************************************************************************************
     *	getters and setters
     **************************************************************************************************/

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set githubId
     *
     * @param string $githubId
     * @return User
     */
    public function setGithubId($githubId)
    {
        $this->githubId = $githubId;
    
        return $this;
    }

    /**
     * Get githubId
     *
     * @return string 
     */
    public function getGithubId()
    {
        return $this->githubId;
    }

    /**
     * Set githubAccessToken
     *
     * @param string $githubAccessToken
     * @return User
     */
    public function setGithubAccessToken($githubAccessToken)
    {
        $this->githubAccessToken = $githubAccessToken;
    
        return $this;
    }

    /**
     * Get githubAccessToken
     *
     * @return string 
     */
    public function getGithubAccessToken()
    {
        return $this->githubAccessToken;
    }

    /**
     * Set twitterId
     *
     * @param string $twitterId
     * @return User
     */
    public function setTwitterId($twitterId)
    {
        $this->twitterId = $twitterId;
    
        return $this;
    }

    /**
     * Get twitterId
     *
     * @return string 
     */
    public function getTwitterId()
    {
        return $this->twitterId;
    }

    /**
     * Set twitterAccessToken
     *
     * @param string $twitterAccessToken
     * @return User
     */
    public function setTwitterAccessToken($twitterAccessToken)
    {
        $this->twitterAccessToken = $twitterAccessToken;
    
        return $this;
    }

    /**
     * Get twitterAccessToken
     *
     * @return string 
     */
    public function getTwitterAccessToken()
    {
        return $this->twitterAccessToken;
    }

    /**
     * Set sensiolabsconnectId
     *
     * @param string $sensiolabsconnectId
     * @return User
     */
    public function setSensiolabsconnectId($sensiolabsconnectId)
    {
        $this->sensiolabsconnectId = $sensiolabsconnectId;
    
        return $this;
    }

    /**
     * Get sensiolabsconnectId
     *
     * @return string 
     */
    public function getSensiolabsconnectId()
    {
        return $this->sensiolabsconnectId;
    }

    /**
     * Set sensiolabsconnectAccessToken
     *
     * @param string $sensiolabsconnectAccessToken
     * @return User
     */
    public function setSensiolabsconnectAccessToken($sensiolabsconnectAccessToken)
    {
        $this->sensiolabsconnectAccessToken = $sensiolabsconnectAccessToken;
    
        return $this;
    }

    /**
     * Get sensiolabsconnectAccessToken
     *
     * @return string 
     */
    public function getSensiolabsconnectAccessToken()
    {
        return $this->sensiolabsconnectAccessToken;
    }

    /**
     * Set emailpolicy_send_on_new_message
     *
     * @param boolean $emailpolicySendOnNewMessage
     * @return User
     */
    public function setEmailpolicySendOnNewMessage($emailpolicySendOnNewMessage)
    {
        $this->emailpolicy_send_on_new_message = $emailpolicySendOnNewMessage;
    
        return $this;
    }

    /**
     * Get emailpolicy_send_on_new_message
     *
     * @return boolean 
     */
    public function getEmailpolicySendOnNewMessage()
    {
        return $this->emailpolicy_send_on_new_message;
    }

    /**
     * Set profileImageName
     *
     * @param string $profileImageName
     * @return User
     */
    public function setProfileImageName($profileImageName)
    {
        $this->profileImageName = $profileImageName;
    
        return $this;
    }

    /**
     * Get profileImageName
     *
     * @return string 
     */
    public function getProfileImageName()
    {
        return $this->profileImageName;
    }

    /**
     * Set created_at
     *
     * @param \DateTime $createdAt
     * @return User
     */
    public function setCreatedAt($createdAt)
    {
        $this->created_at = $createdAt;
    
        return $this;
    }

    /**
     * Get created_at
     *
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * Set updated_at
     *
     * @param \DateTime $updatedAt
     * @return User
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updated_at = $updatedAt;
    
        return $this;
    }

    /**
     * Get updated_at
     *
     * @return \DateTime 
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }
}