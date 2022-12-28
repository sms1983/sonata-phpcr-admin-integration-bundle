<?php

/*
 * This file is part of the Symfony CMF package.
 *
 * (c) 2011-2017 Symfony CMF
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Cmf\Bundle\SonataPhpcrAdminIntegrationBundle\Admin\Block;

use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Cmf\Bundle\TreeBrowserBundle\Form\Type\TreeSelectType;

/**
 * @author Lukas Kahwe Smith <smith@pooteeweet.org>
 */
class ReferenceBlockAdmin extends AbstractBlockAdmin
{
    /**
     * {@inheritdoc}
     */
    protected function configureListFields(ListMapper $list): void
    {
        $list
            ->addIdentifier('id', 'text')
            ->add('name', 'text')
        ;
    }

    /**
     * {@inheritdoc}
     */
    protected function configureFormFields(FormMapper $form): void
    {
        parent::configureFormFields($form);

        $form
            ->tab('form.tab_general')
                ->with('form.group_block', ['class' => 'col-md-9'])
                    ->add(
                        'referencedBlock',
                        TreeSelectType::class,
                        ['root_node' => $this->getRootPath(), 'widget' => 'browser', 'required' => false]
                    )
                ->end()
            ->end()
        ;

        $this->addTransformerToField($form->getFormBuilder(), 'referencedBlock');
    }

    /**
     * {@inheritdoc}
     */
    protected function configureDatagridFilters(DatagridMapper $filter): void
    {
        // $filter
        //     ->add('name', 'doctrine_phpcr_nodename')
        // ;
    }
}
