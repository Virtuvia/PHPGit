<?php

namespace PHPGit\Command;

use PHPGit\Command;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RevParseCommand extends Command
{
    public function __invoke($revision, array $options = [])
    {
        $options = $this->resolve($options);

        $builder = $this->git->getProcessBuilder()
            ->add('rev-parse');

        if ($options['short']) {
            $builder->add('--short');
        }

        $builder->add($revision);

        $output = $this->git->run($builder->getProcess());

        return trim($output);
    }

    public function setDefaultOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'short' => false,
        ]);

        $resolver->setAllowedTypes('short', 'bool');
    }
}