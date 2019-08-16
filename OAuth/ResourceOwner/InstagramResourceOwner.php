<?php

/*
 * This file is part of the HWIOAuthBundle package.
 *
 * (c) Hardware Info <opensource@hardware.info>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace HWI\Bundle\OAuthBundle\OAuth\ResourceOwner;

use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * InstagramResourceOwner.
 *
 * @author Jean-Christophe Cuvelier <jcc@atomseeds.com>
 */
class InstagramResourceOwner extends GenericOAuth2ResourceOwner
{
    /**
     * {@inheritdoc}
     */
    protected $paths = [
        'identifier' => 'data.id',
        'nickname' => 'data.username',
        'realname' => 'data.full_name',
        'profilepicture' => 'data.profile_picture',
    ];

    /**
     * {@inheritdoc}
     */
    protected function doGetUserInformationRequest($url, array $parameters = [])
    {
        return $this->httpRequest($this->normalizeUrl($url, $parameters), null, [], 'GET');
    }

    /**
     * {@inheritdoc}
     */
    protected function configureOptions(OptionsResolver $resolver)
    {
        parent::configureOptions($resolver);

        $resolver->setDefaults([
            'authorization_url' => 'https://api.instagram.com/oauth/authorize',
            'access_token_url' => 'https://api.instagram.com/oauth/access_token',
            'infos_url' => 'https://api.instagram.com/v1/users/self',

            // Instagram supports authentication with only one defined URL
            'auth_with_one_url' => true,

            'use_bearer_authorization' => false,
        ]);
    }
}
