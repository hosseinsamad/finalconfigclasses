<?php

namespace finalconfigclasses\bean;

interface DiffableBean {

	/**
	 * Specifies that SubDiff needed for property.
	 * Specifies that sub-element inside xml is reached.
	 *
	 * Specifies current property is an independent bean for computing beanDiff and
	 * its changes should be recorded to new BeanDiff object, not in parent BeanDiff.
	 */
	public function needsSubdiff($propertyName);

	/**
	 * Returns the object which should be used to compute
	 * the beandiff for this bean.
	 */
	public function _newDiffHelper();

	/**
	 * The beanID should be unique for each bean instance(except of cloned one
	 * which has a same beanID). If you reuse the same beanID for different
	 * objects then the beanDiff algorithm can not distinct between them. So
	 * do not change the default implementation and use what is provided in
	 * API.
	 */
	public function _getBeanID();

	/**
	 * The interface or class which this method returns
	 * would be used to find properties for beandiff algorithm.
	 */
	public function _getBeanClass();
}
