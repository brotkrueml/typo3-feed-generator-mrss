.. include:: /Includes.rst.txt

.. _developer:

================
Developer corner
================

This extension provides classes to add Media RSS features to an Atom or RSS
feed.

.. note::
   Currently only a subset of the Media RSS specification is available via
   this extension. In the following sections the available features are
   described. If you have the need for more compatibility with the specification
   please open a `feature request`_.

.. _feature request: https://github.com/brotkrueml/typo3-feed-generator-mrss/issues


An introduction on how to create a feed can be found in the
:ref:`documentation of the Feed Generator <ext_feed_generator:developer>`.
Have also a look into the `Media RSS specification`_.

.. _Media RSS specification: https://www.rssboard.org/media-rss


Media content
=============

A :html:`<media:content>` element can be created using the :php:`MediaContent`
value object:

.. code-block:: php
   :caption: EXT:your_extension/Classes/Feed/YourFeed.php

   // use Brotkrueml\FeedGeneratorMrss\ValueObject\MediaContent;

   $mediaContent = new MediaContent();

The object provides many methods to set the according properties, for example:

.. code-block:: php
   :caption: EXT:your_extension/Classes/Feed/YourFeed.php

   // use Brotkrueml\FeedGeneratorMrss\Enumeration\Medium;
   // use Brotkrueml\FeedGeneratorMrss\ValueObject\MediaThumbnail;

   $mediaContent
      ->setUrl('https://example.org/some-video.mp4')
      ->setFileSize(12345678)
      ->setType('video/mp4')
      ->setTitle('Some video title')
      ->setDescription('<p>This is an awesome video.</p>')
      ->setMedium(Medium::Video)
      ->setThumbnail(
         new MediaThumbnail('https://example.org/some-image.jpg', 75, 50, '12:05:01.123')
      )
   ;

Now we can assign it to a feed item:

.. code-block:: php
   :caption: EXT:your_extension/Classes/Feed/YourFeed.php

   // use Brotkrueml\FeedGenerator\Entity\Item;

   $item = new Item();
   // ... other properties are assigned
   $item->addExtensionContents($mediaContent);

For an RSS feed this will result in:

.. code-block:: xml

   <item>
      <!-- ... other properties -->
      <media:content
         url="https://example.org/some-video.mp4"
         fileSize="12345678"
         type="video/mp4"
         medium="video"
      >
         <media:title>Some video title</media:title>
         <media:description>&lt;p&gt;This is an awesome video.&lt;/p&gt;</media:description>
         <media:thumbnail
            url="https://example.org/some-image.jpg"
            width="75"
            height="50"
            time="12:05:01.123"
         />
      </media:content>
   </item>

.. tip::

   The :ref:`API <api>` provides a reference of all classes and enumerations
   with their according methods and properties.
