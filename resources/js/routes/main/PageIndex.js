import React from 'react'
import PropTypes from 'prop-types'
import { withStyles } from '@material-ui/core/styles'
import {
  IndexLayout ,
  PostCard,
  Layout } from '../../components/layouts/main'
  import ImageSlider from '../../components/layouts/main/slider/ImageSlider'
  

import Calendar from 'react-calendar';

const styles = theme => ({
  post: {
    marginBottom: theme.spacing(3),
  }
});
let myDate = null;
const onChange = date =>{
  myDate = date;
  console.log(date);
} 
const date = new Date(); 
const PageIndex = ({ classes }) => (

  <IndexLayout>
    <ImageSlider />
    <Layout

    aside={
      <Calendar onChange={()=>onChange(myDate)} navigationAriaLabel='School Events'/>
    } >

    <PostCard
      className={classes.post}
      title="Burrata Black Bean Burgers"
      subtitle="@Sandra posted 3 days ago"
      imageUrl="https://source.unsplash.com/sWq83ZbZb6U/1600x900"
      avatarUrl="https://source.unsplash.com/EGVccebWodM/150x150"
      body="These vegetarian burgers are delicious! Your carnivorous friends will be impressed. My favorite way to serve is on a whole-wheat bun with garlic-lemon mayonnaise, fresh raw spinach, sliced tomato, and caramelized onions!"
    />
    <PostCard
      className={classes.post}
      title="Vegan Shepherd's Pie"
      subtitle="@Janne posted 1 week ago"
      imageUrl="https://source.unsplash.com/l_DY1GYtjTo/1600x900"
      avatarUrl="https://source.unsplash.com/yl2rJVuNWFQ/150x150"
      body="Looks yummy, but not very healthy at all. I'll try leaving out the vegan mayo and cream cheese. I think I might try it with soaked, chopped walnuts and quinoa rather than the soy meat substitute. Otherwise, this looks like something that might be really nice to serve when omnivores are visiting :)"
    />
    <PostCard
      className={classes.post}
      title="Rice cake eggs"
      subtitle="@James posted 2 weeks ago"
      imageUrl="https://source.unsplash.com/kZeUekYF9Jw/1600x900"
      avatarUrl="https://source.unsplash.com/d2MSDujJl2g/150x150"
      body="When you've got the whole gang along for the camping trip, make breakfast eggs the easy way and enjoy a slow sip of your coffee while they cook! Simply pour whole eggs or scrambled eggs into a greased muffin tin and set on a grate over your fire or cook on your hot grill. "
    />
    </Layout>
    </IndexLayout>
);

PageIndex.propTypes = {
  classes: PropTypes.objectOf(PropTypes.string),
};

export default withStyles(styles)(PageIndex);
