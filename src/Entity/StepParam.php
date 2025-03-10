<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

/**
 * @ORM\Entity
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="type", type="string", columnDefinition="param_type")
 * @ORM\DiscriminatorMap({
 *     "inline"="App\Entity\InlineStepParam",
 *     "multiline"="App\Entity\MultilineStepParam",
 *     "table"="App\Entity\TableStepParam"
 * })
 *
 * @Serializer\Discriminator(
 *     field="type",
 *     map={
 *      "inline": "App\Entity\InlineStepParam",
 *      "multiline": "App\Entity\MultilineStepParam",
 *      "table": "App\Entity\TableStepParam"
 *     },
 *     groups={"READ_FEATURE"}
 * )
 */
abstract class StepParam
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     *
     * @Serializer\Groups({"READ_FEATURE"})
     */
    public ?int $id = null;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\ScenarioStep", inversedBy="params")
     */
    public ScenarioStep $step;
}
