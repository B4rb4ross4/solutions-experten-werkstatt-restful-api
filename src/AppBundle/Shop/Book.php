<?php
namespace AppBundle\Shop;

use JMS\Serializer\Annotation as Serialize;

/**
 * Class Book
 * @package AppBundle\Shop
 *
 * @Serialize\XmlRoot(name="book")
 */
class Book
{

  /**
   * @Serialize\Expose()
   * @Serialize\XmlAttribute()
   * @Serialize\Type("string")
   * @var string
   */
  private $isbn;
  /**
   * @var string
   * @Serialize\Expose()
   * @Serialize\Type("string")
   */
  private $title;
  /**
   * @var mixed
   * @Serialize\Exclude()
   * @Serialize\Expose()
   * @Serialize\Type("string")
   */
  private $abstract;

  public function __construct($title, $isbn, $abstract = null)
  {
    /** @var string isbn */
    $this->isbn = $isbn;
    /** @var string title */
    $this->title = $title;
    $this->abstract = $abstract;
  }

  /**
   * @return string
   */
  public function getTitle()
  {
    return $this->title;
  }

  /**
   * @return string
   */
  public function getIsbn()
  {
    return $this->isbn;
  }

  /**
   * @return null
   */
  public function getAbstract()
  {
    return $this->abstract;
  }

}